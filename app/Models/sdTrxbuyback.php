<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class sdTrxbuyback extends Model
{
    use HasFactory;

    public function getBBFilter($bbno, $bbdate1, $bbdate2, $customer, $creator, $status, $article){
        $qry = "SELECT bb.*, DATE_FORMAT(bb.TanggalBB, '%d/%m/%Y') BBDate, c.Nama NamaCustomer FROM sd_trxbuybacks bb JOIN (SELECT * FROM sd_mastercustomers WHERE updated_at is NULL) c ON c.IDCustomer = bb.IDCustomer ";

        if($bbno != '')
            return DB::select($qry."WHERE bb.KodeBB = '".$bbno."'");

        if($bbdate1 != ''){
            $bbdate1 = date_format(date_create_from_format('d/m/Y',$bbdate1),"Y-m-d");
            if($bbdate2 != ''){
                $bbdate2 = date_format(date_create_from_format('d/m/Y', $bbdate2),"Y-m-d");
                $qry = $qry."WHERE bb.TanggalBB BETWEEN '".$bbdate1."' AND '".$bbdate2."' ";
            }else
                $qry = $qry."WHERE bb.TanggalBB = '".$bbdate1."' ";
            
            if($customer != '')
                $qry = $qry." AND c.Nama LIKE '%".$customer."%' ";
            if($creator != 'null')
                $qry = $qry." AND bb.IDUserCreator = ".$creator;
            if($status != 'null')
                $qry = $qry." AND bb.Status = ".$status % 2;
        }else{
            // Untuk kasih cek perlu pake WHERE ga
            if($customer != '' || $creator != "null" || $status != 'null')
                $qry = $qry." WHERE ";
            
            if($customer != '')
                $qry = $qry." c.Nama LIKE '%".$customer."%' ";
            if($creator != 'null'){
                if($customer != '')
                    $qry = $qry." AND bb.IDUserCreator = ".$creator;
                else
                    $qry = $qry." bb.IDUserCreator = ".$creator;
            }
            if($status != 'null'){
                if($customer != '' || $creator != 'null')
                    $qry = $qry." AND bb.Status = ".$status % 2;
                else
                    $qry = $qry." bb.Status = ".$status % 2;
            }
            if($article != ''){
                if($customer != '' || $creator != 'null' || $status != 'null')
                    $qry = $qry." AND (bb.KodeArticle LIKE '%".$article."%' OR bb.NamaArticle LIKE '%".$article."%' ) ";
                else
                    $qry = $qry." (bb.KodeArticle LIKE '%".$article."%' OR bb.NamaArticle LIKE '%".$article."%' ) ";
            }
        }
        return DB::select($qry);
    }

    public function getBBByID($id){
        return DB::select("SELECT bb.*, DATE_FORMAT(bb.TanggalBB, '%d/%m/%Y') BBDate, img.Path, 
                c.Nama NamaCustomer, c.Telepon, c.Telepon2, c.Email, c.Alamat, DATE_FORMAT(c.TanggalLahir, '%d/%m/%Y') TanggalLahir
                FROM sd_trxbuybacks bb JOIN sd_masterarticleimages img ON bb.IDArticle = img.IDArticle 
                JOIN (SELECT * FROM sd_mastercustomers WHERE updated_at is NULL) c 
                ON c.IDCustomer = bb.IDCustomer WHERE IDBuyBack = ".$id);
    }

    public function updateBB($req){
        try {
            $this::where('IDBuyBack', $req['idbb'])
                    ->update([
                        'Status' => 0,
                    ]);
            return 'berhasil';
        } catch(\Illuminate\Database\QueryException $ex){ 
            return 'error';
        }
    }

    public function createBB($req){
        $artModel = new sdMasterarticle;
        $nos_model = new sdNoseries;
        $allocModel = new sdMasterzalloc;
        $mutModel = new sdMutation;
        $soModel = new sdTrxso;

        $datart =  $artModel->getArticleByCode($req['idart']);

        // Cek SO nya sudah ada buyback aktif belum
        $dataso = DB::select("SELECT * FROM sd_trxsos so JOIN sd_trxbuybacks bb ON so.KodeBB = bb.KodeBB 
                            WHERE so.KodeSO = '".$req['sono']."' AND bb.Status = 1");
        if(count($dataso) > 0)
            return 'so';

        $nos = '';
        $bbdate = date_format(date_create_from_format('d/m/Y', $req['bbdate']),"Y-m-d");

        $nos = $nos_model->returnNoBB('B',$bbdate,'Buy Back');
        
        try {
            $this::create([
                'KodeBB' => $nos,
                'KodeSO' => $req['sono'],
                'IDUserCreator' => Auth::user()->id,
                'NamaUserCreator' => Auth::user()->NamaUser,
                'IDCustomer' => $req['idcus'],
                'IDArticle' => $datart[0]->IDArticle,
                'KodeArticle' => $datart[0]->KodeArticle,
                'NamaArticle' => $datart[0]->NamaArticle,
                'BeratEmas' => $datart[0]->BeratEmas,
                'Karat' => $datart[0]->Karat,
                'TanggalBB' => $bbdate,
                'Harga' => $datart[0]->SellingPrice,
                'HargaFinal' => $req['hargafinal'],
                'Note' => $req['note'],
                'Status' => 1,
            ]);
            $nos_model->returnNoBBUpdate('B',$bbdate);

            $soModel::where('KodeSO', $req['sono'])
                    ->update([
                        'KodeBB' => $nos,
                        'IDUserUpdater' => Auth::user()->id,
                        'NamaUserUpdater' => Auth::user()->NamaUser,
                        'updated_at' => NOW(),
                    ]);

            if($datart[0]->IDZAlloc == 4){
                $from = $allocModel->getTypeByID($datart[0]->IDZAlloc);
                $to = $allocModel->getTypeByID(1);
                $mutModel->createMutation($nos, $datart[0]->IDArticle, $datart[0]->KodeArticle, $datart[0]->NamaArticle,
                        $from[0]->IDZAlloc, $from[0]->KodeAlloc.' - '.$from[0]->NamaAlloc,
                        $to[0]->IDZAlloc, $to[0]->KodeAlloc.' - '.$to[0]->NamaAlloc, $req['note']);
                $artModel->updateArticleAlloc(1,$datart[0]->IDArticle);
                DB::update("UPDATE sd_masterarticles SET Buyback = 1 WHERE KodeArticle = '".$datart[0]->KodeArticle."'");
            }

            return $nos;
        } catch(\Illuminate\Database\QueryException $ex){ 
            return 'error';
        }
    }

    protected $fillable = [
        'KodeBB',
        'KodeSO',
        'KodeInv',
        'IDUserCreator',
        'NamaUserCreator',
        'IDCustomer',
        'IDArticle',
        'KodeArticle',
        'NamaArticle',
        'BeratEmas',
        'TanggalBB',
        'Karat',
        'Harga',
        'HargaFinal',
        'Note',
        'Status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class sdTrxso extends Model
{
    use HasFactory;

    public function getSOByID($id){
        return DB::select("SELECT so.*, DATE_FORMAT(so.TanggalSO, '%d/%m/%Y') SODate, img.Path, 
                c.Nama NamaCustomer, c.Telepon, c.Telepon2, c.Email, c.Alamat, DATE_FORMAT(c.TanggalLahir, '%d/%m/%Y') TanggalLahir
                FROM sd_trxsos so JOIN sd_masterarticleimages img ON so.IDArticle = img.IDArticle 
                JOIN (SELECT * FROM sd_mastercustomers WHERE updated_at is NULL) c 
                ON c.IDCustomer = so.IDCustomer WHERE IDSO = ".$id);
    }

    // Untuk BuyBack
    public function getSOByKode($kode){
        return DB::select("SELECT so.*, DATE_FORMAT(so.TanggalSO, '%d/%m/%Y') SODate, img.Path, 
                c.Nama NamaCustomer, c.Telepon, c.Telepon2, c.Email, c.Alamat, DATE_FORMAT(c.TanggalLahir, '%d/%m/%Y') TanggalLahir
                FROM sd_trxsos so JOIN sd_masterarticleimages img ON so.IDArticle = img.IDArticle 
                JOIN (SELECT * FROM sd_mastercustomers WHERE updated_at is NULL) c 
                ON c.IDCustomer = so.IDCustomer 
                WHERE so.KodeSO = '".$kode."' AND so.Status = 1");
    }

    public function getSOFilter($sono, $sodate1, $sodate2, $customer, $creator, $updater, $status, $article){
        $qry = "SELECT so.*, DATE_FORMAT(so.TanggalSO, '%d/%m/%Y') SODate, c.Nama NamaCustomer FROM sd_trxsos so JOIN (SELECT * FROM sd_mastercustomers WHERE updated_at is NULL) c ON c.IDCustomer = so.IDCustomer ";
        
        if($sono != '')
            return DB::select($qry."WHERE so.KodeSO = '".$sono."'");

        if($sodate1 != ''){
            $sodate1 = date_format(date_create_from_format('d/m/Y', $sodate1),"Y-m-d");
            if($sodate2 != ''){
                $sodate2 = date_format(date_create_from_format('d/m/Y',$sodate2),"Y-m-d");
                
                $qry = $qry."WHERE so.TanggalSO BETWEEN '".$sodate1."' AND '".$sodate2."' ";
            }else
                $qry = $qry."WHERE so.TanggalSO = '".$sodate1."' ";
            
            if($customer != '')
                $qry = $qry." AND c.Nama LIKE '%".$customer."%' ";
            if($creator != 'null')
                $qry = $qry." AND so.IDUserCreator = ".$creator;
            if($updater != 'null')
                $qry = $qry." AND so.IDUserUpdater = ".$updater;
            if($status != 'null')
                $qry = $qry." AND so.Status = ".$status % 2;
        }else{
            // Untuk kasih cek perlu pake WHERE ga
            if($customer != '' || $article != '' || $creator != "null" || $updater != "null" || $status != 'null')
                $qry = $qry." WHERE ";
            
            if($customer != '')
                $qry = $qry." c.Nama LIKE '%".$customer."%' ";
            if($creator != 'null'){
                if($customer != '')
                    $qry = $qry." AND so.IDUserCreator = ".$creator;
                else
                    $qry = $qry." so.IDUserCreator = ".$creator;
            }
            if($updater != 'null'){
                if($customer != '' || $creator != 'null')
                    $qry = $qry." AND so.IDUserUpdater = ".$updater;
                else
                    $qry = $qry." so.IDUserUpdater = ".$updater;
            }
            if($status != 'null'){
                if($customer != '' || $creator != 'null' || $updater != 'null')
                    $qry = $qry." AND so.Status = ".$status % 2;
                else
                    $qry = $qry." so.Status = ".$status % 2;
            }
            if($article != ''){
                if($customer != '' || $creator != 'null' || $updater != 'null' || $status != 'null')
                    $qry = $qry." AND (so.KodeArticle LIKE '%".$article."%' OR so.NamaArticle LIKE '%".$article."%' ) ";
                else
                    $qry = $qry." (so.KodeArticle LIKE '%".$article."%' OR so.NamaArticle LIKE '%".$article."%' ) ";
            }
        }
        // return $qry;
        return DB::select($qry);
    }

    public function updateSO($req){
        $allocModel = new sdMasterzalloc;
        $mutModel = new sdMutation;
        $datart = DB::select("SELECT art.*, so.KodeSO FROM sd_masterarticles art JOIN sd_trxsos so ON art.IDArticle = so.IDArticle
                            WHERE so.IDSO = ".$req['idso']);

        // Cek kalau msh ada buyback aktif nya, ga bisa dideactive
        $dataso = DB::select("SELECT * FROM sd_trxsos so WHERE IDSO = ".$req['idso']);
        if($dataso[0]->KodeBB != '')
            return 'bb';
        if($datart[0]->IDZAlloc != 4)
            return 'lokasi';

        try {
            $this::where('IDSO', $req['idso'])
                    ->update([
                        'Status' => 0,
                        'IDUserUpdater' => Auth::user()->id,
                        'NamaUserUpdater' => Auth::user()->NamaUser,
                        'updated_at' => NOW(),
                    ]);
            $from = $allocModel->getTypeByID($datart[0]->IDZAlloc);
            $to = $allocModel->getTypeByID(2);
            $mutModel->createMutation($datart[0]->KodeSO, $datart[0]->IDArticle, $datart[0]->KodeArticle, $datart[0]->NamaArticle,
                    $from[0]->IDZAlloc, $from[0]->KodeAlloc.' - '.$from[0]->NamaAlloc,
                    $to[0]->IDZAlloc, $to[0]->KodeAlloc.' - '.$to[0]->NamaAlloc, 'Deactive SO');
            return 'berhasil';
        } catch(\Illuminate\Database\QueryException $ex){ 
            return 'error';
        }
    }

    public function createSO($req){
        $artModel = new sdMasterarticle;
        $nos_model = new sdNoseries;
        $allocModel = new sdMasterzalloc;
        $mutModel = new sdMutation;
    
        $datart =  $artModel->getArticleByCode($req['idart']);

        if($datart[0]->IDZAlloc != 2)
            return "lokasi";

        // Kalau item belum di BB cek apa ada SO aktif dengan item yang sama
        if($datart[0]->Buyback == 0){
            $cekSO = DB::select("SELECT * FROM sd_trxsos WHERE Status = 1 AND KodeArticle = '".$req['idart']."'");
            if(count($cekSO) > 0)
                return "so";
        }

        $nos = '';
        $sodate = date_format(date_create_from_format('d/m/Y', $req['sodate']),"Y-m-d");
        
        $nos = $nos_model->returnNoSo('S',$sodate,'Sales Order');
        
        try {
            $this::create([
                'KodeSO' => $nos,
                'KodeBB' => '',
                'IDUserCreator' => Auth::user()->id,
                'IDUserUpdater' => Auth::user()->id,
                'NamaUserCreator' => Auth::user()->NamaUser,
                'NamaUserUpdater' => Auth::user()->NamaUser,
                'IDCustomer' => $req['idcus'],
                'IDArticle' => $datart[0]->IDArticle,
                'KodeArticle' => $datart[0]->KodeArticle,
                'NamaArticle' => $datart[0]->NamaArticle,
                'BeratEmas' => $datart[0]->BeratEmas,
                'Karat' => $datart[0]->Karat,
                'TanggalSO' => $sodate,
                'Harga' => $datart[0]->SellingPrice,
                'HargaFinal' => $req['hargafinal'],
                'Note' => $req['note'],
                'Status' => 1,
            ]);
            $nos_model->returnNoSoUpdate('S',$sodate);
            
            $from = $allocModel->getTypeByID($datart[0]->IDZAlloc);
            $to = $allocModel->getTypeByID(4);
            $mutModel->createMutation($nos, $datart[0]->IDArticle, $datart[0]->KodeArticle, $datart[0]->NamaArticle,
                    $from[0]->IDZAlloc, $from[0]->KodeAlloc.' - '.$from[0]->NamaAlloc,
                    $to[0]->IDZAlloc, $to[0]->KodeAlloc.' - '.$to[0]->NamaAlloc, $req['note']);

            return $nos;
        } catch(\Illuminate\Database\QueryException $ex){ 
            return 'error';
        }
    }

    public function cekArticleInSO($idart){
        $cekSO = DB::select("SELECT * FROM sd_trxsos WHERE Status = 1 AND IDArticle = ".$idart);
        if(count($cekSO) > 0)
            return "so";
        return "null";
    }

    public function cekGL($date1, $date2){
        $date1 = date_format(date_create($date1),"Y-m-d");
        $date2 = date_format(date_create($date2),"Y-m-d");
        
        return DB::select("SELECT 'so' as Tipe, so.IDSO IDDoc, so.KodeSO KodeDoc, DATE_FORMAT(so.TanggalSO, '%d/%m/%Y') TanggalDoc, so.IDArticle,
        so.KodeArticle, so.NamaArticle, so.BeratEmas, so.Karat, so.Harga, so.HargaFinal,
        c.IDCustomer, c.Nama as NamaCust
        FROM sd_trxsos so JOIN sd_mastercustomers c ON c.IDCustomer =  so.IDCustomer
        WHERE Status = 1 AND (so.TanggalSO BETWEEN '".$date1."' AND '".$date2."')
        UNION
        SELECT 'bb' as Tipe, bb.IDBuyBack IDDoc, bb.KodeBB KodeDoc, DATE_FORMAT(bb.TanggalBB, '%d/%m/%Y') TanggalDoc, bb.IDArticle,
        bb.KodeArticle, bb.NamaArticle, bb.BeratEmas, bb.Karat, bb.Harga, bb.HargaFinal,
        c.IDCustomer, c.Nama as NamaCust
        FROM sd_trxbuybacks bb JOIN sd_mastercustomers c ON c.IDCustomer =  bb.IDCustomer
        WHERE Status = 1 AND (bb.TanggalBB BETWEEN '".$date1."' AND '".$date2."')
        ORDER BY TanggalDoc");
    }

    protected $fillable = [
        'KodeSO',
        'KodeBB',
        'IDUserCreator',
        'IDUserUpdater',
        'NamaUserCreator',
        'NamaUserUpdater',
        'IDCustomer',
        'IDArticle',
        'KodeArticle',
        'NamaArticle',
        'BeratEmas',
        'Karat',
        'TanggalSO',
        'Harga',
        'HargaFinal',
        'Note',
        'Status',
        'updated_at',
    ];
}

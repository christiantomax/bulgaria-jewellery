<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\sdNoseries;


class sdMasterarticle extends Model
{
    use HasFactory;

    public function getArticleReady($idtype){
        return DB::select("SELECT * FROM sd_masterarticles WHERE IDZAlloc = 2 AND Block = 0
                    AND IDArticleType = ".$idtype);
    }

    public function getArticleAll(){
        return DB::select("SELECT * FROM sd_masterarticles ORDER BY IDArticle");
    }

    public function getArticleByType($idtype){
        return DB::select("SELECT a.*, b.path as 'path'
        FROM sd_masterarticles a
        join sd_masterarticleimages b on a.IDArticle = b.IDArticle
        where  a.IDArticleType =  ".$idtype."
        ORDER BY IDArticle");
    }

    public function getArticleByAlloc($idalloc){
        if($idalloc == "all")
            return DB::select("SELECT * FROM sd_masterarticles");
        return DB::select("SELECT * FROM sd_masterarticles WHERE IDZAlloc = ".$idalloc);
    }

    // Untuk Detail Article No FIlter (Mutation)
    public function getArticleByCode($kodeart){
        return DB::select("SELECT art.*, img.Path, tp.KodeAwal, tp.NamaJenisArticle, sup.IDSupplier, sup.Kode, sup.Nama NamaSupplier FROM sd_masterarticles art LEFT JOIN sd_masterarticleimages img
            ON art.IDArticle = img.IDArticle JOIN sd_articletypes tp ON art.IDArticleType = tp.IDArticleType
            JOIN (SELECT * FROM sd_mastersuppliers) sup ON sup.id = art.IDSUpplier
            WHERE KodeArticle = '".$kodeart."'");
    }

    //Untuk Detail Article di SO
    public function getArticleByCodeSO($kodeart){
        return DB::select("SELECT art.*, img.Path, tp.KodeAwal, tp.NamaJenisArticle FROM sd_masterarticles art LEFT JOIN sd_masterarticleimages img
            ON art.IDArticle = img.IDArticle JOIN sd_articletypes tp ON art.IDArticleType = tp.IDArticleType
            WHERE KodeArticle = '".$kodeart."' AND Block = 0 AND IDZAlloc = 2");
    }

    //Untuk Detail Article di BB
    public function getArticleByCodeBB($kodeart){
        return DB::select("SELECT art.*, img.Path, tp.KodeAwal, tp.NamaJenisArticle FROM sd_masterarticles art LEFT JOIN sd_masterarticleimages img
            ON art.IDArticle = img.IDArticle JOIN sd_articletypes tp ON art.IDArticleType = tp.IDArticleType
            WHERE KodeArticle = '".$kodeart."' AND Block = 0 AND IDZAlloc = 3");
    }

    public function getArticleByKodeArticle($kodeart){
        $db = DB::select("SELECT IDArticle FROM sd_masterarticles WHERE KodeArticle = '".$kodeart."'");
        return $db;
    }

    public function updateArticle($req){
        DB::update("UPDATE `sd_masterarticles` SET `NamaArticle`='".$req->nama."',`BeratEmas`='".$req->berat."',`Karat`='".$req->karat."',
            `SellingPrice`=".$req->harga.",`Block`=".$req->block.",`Note`='".$req->note."',`updated_at`= NOW() WHERE IDArticle = ".$req->id);
    }

    public function updateArticleAlloc($idalloc, $idart){
        DB::update("UPDATE sd_masterarticles SET IDZAlloc = ".$idalloc." WHERE IDArticle = ".$idart);
    }

    public function createArticleMaster($req){
        $nos_model = new sdNoseries;
        $nos = '';
        $nos = $nos_model->returnNoArticle($req->articletype);

        try {
            DB::insert("insert into `sd_masterarticles`(`IDArticle`, `IDSupplier`, `IDZAlloc`, `IDArticleType`, `KodeArticle`, `NamaArticle`, `BeratEmas`, `Karat`, `SellingPrice`, `Block`, `Buyback`, `Note`, `created_at`, `updated_at`) VALUES (NULL,'".$req['idsupplier']."','".$req['articleallocation']."','".$req['articletypeid']."','".$nos."','".$req['articlename']."','".$req['articleweight']."','".$req['articlekarat']."','".$req['articlepurchaseprice']."',0, 0, '-','".NOW()."',NULL)");
                return $nos;
        } catch(\Illuminate\Database\QueryException  $ex){
            $nos_model->returnNoTglCancel($req->articletype);
            return 'error';
            // return $ex->getMessage();
        }
    }

    protected $fillable = [
        'IDSupplier',
        'IDZAlloc',
        'IDArticleType',
        'KodeArticle',
        'NamaArticle',
        'BeratEmas',
        'Karat',
        'SellingPrice',
        'Block',
        'Buyback',
        'Note',
    ];
}

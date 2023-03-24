<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class sdTrxpo extends Model
{
    use HasFactory;
    protected $fillable = [
            'IDPO',
            'IDSupplier',
            'IDArticle',
            'Harga',
            'ExchangeRate',
            'TglJatuhTempo',
            'Note',
            'IDUser',
            'updated_at',
            'NotaSupplier',
            'KodeBarangSupplier'
    ];

    public function getPOnow(){
        return DB::select("SELECT po.IDPO, CONCAT(supplier.IDSupplier,' ',supplier.Nama) as Supplier, format(sum(po.harga),0) as TotalPurchasePriceDollar, format(sum(po.harga*po.ExchangeRate),0) as TotalPurchasePriceRupiah, po.ExchangeRate, DATE_FORMAT(po.TglJatuhTempo, '%a, %d %b %Y') as TglJatuhTempo, DATE_FORMAT(po.created_at, '%a, %d %b %Y') as created_at, users.NamaUser,
        po.NotaSupplier, po.KodeBarangSupplier as users from sd_trxpos po
        join sd_mastersuppliers supplier on po.IDSupplier = supplier.id
        join users users on po.IDUser = users.id
        WHERE MONTH(po.created_at) = MONTH(NOW()) AND YEAR(po.created_at) = YEAR(NOW())
        group by po.IDPO
        order by po.created_at desc");
    }

    public function getPOfilter($request){
        $counter = 0;
        $query = "SELECT po.IDPO, CONCAT(supplier.IDSupplier,' ',supplier.Nama) as Supplier, format(sum(po.harga),0) as TotalPurchasePriceDollar, format(sum(po.harga*po.ExchangeRate),0) as TotalPurchasePriceRupiah, po.ExchangeRate, DATE_FORMAT(po.TglJatuhTempo, '%a, %d %b %Y') as TglJatuhTempo, DATE_FORMAT(po.created_at, '%a, %d %b %Y') as created_at, users.NamaUser as users,
        po.NotaSupplier, po.KodeBarangSupplier from sd_trxpos po
        join sd_mastersuppliers supplier on po.IDSupplier = supplier.ID
        join users users on po.IDUser = users.id
        WHERE ";
        if($request->idpo != ""){
            $query = $query."po.IDPO >= '".$request->idpo."'";
            $counter++;
        }
        if($request->podateawal != ""){
            if($counter != 0){
                $query = $query." and ";
            }
            $query = $query."po.created_at >= '".$request->podateawal."'";
            $counter++;
        }
        if($request->podateakhir != ""){
            if($counter != 0){
                $query = $query." and ";
            }
            $query = $query."po.created_at <= '".$request->podateakhir."'";
            $counter++;
        }
        if($request->duedateawal != ""){
            if($counter != 0){
                $query = $query." and ";
            }
            $query = $query."po.TglJatuhTempo >= '".$request->duedateawal."'";
            $counter++;
        }
        if($request->duedateakhir != ""){
            if($counter != 0){
                $query = $query." and ";
            }
            $query = $query."po.TglJatuhTempo <= '".$request->duedateakhir."'";
            $counter++;
        }
        if($request->supplier != ""){
            if($counter != 0){
                $query = $query." and ";
            }
            $query = $query."po.IDSupplier <= '".$request->supplier."'";
            $counter++;
        }
        if($request->creator != ""){
            if($counter != 0){
                $query = $query." and ";
            }
            $query = $query."users.id <= '".$request->creator."'";
            $counter++;
        }
        $query = $query."
        group by po.IDPO";
        return DB::select($query);
    }

    public function getPODetailHeader($idpo){
        return DB::select("SELECT po.IDPO, CONCAT(supplier.IDSupplier,' ',supplier.Nama) as Supplier, format(sum(po.harga),0) as TotalPurchasePriceDollar, format(sum(po.harga*po.ExchangeRate),0) as TotalPurchasePriceRupiah, po.ExchangeRate,  DATE_FORMAT(po.TglJatuhTempo, '%a, %d %b %Y') as TglJatuhTempo,  DATE_FORMAT(po.created_at, '%a, %d %b %Y') as created_at, users.NamaUser as users, 
        po.NotaSupplier, po.KodeBarangSupplier from sd_trxpos po
        join sd_mastersuppliers supplier on po.IDSupplier = supplier.id
        join users users on po.IDUser = users.id
        where po.IDPO = '".$idpo."'
        group by po.IDPO");
    }

    public function getPODetail($idpo){
        return DB::select("SELECT article.KodeArticle, article.NamaArticle, articletype.NamaJenisArticle, concat('[',alloc.KodeAlloc,'] ',alloc.NamaAlloc) as AllocationFirst, po.Harga as HargaDollar, (po.Harga*po.ExchangeRate) as HargaRupiah, article.BeratEmas, article.Karat, articleimage.Path,
        po.NotaSupplier, po.KodeBarangSupplier from sd_trxpos po
        join sd_masterarticles article on po.IDArticle = article.IDArticle
        join sd_masterarticleimages articleimage on articleimage.IDArticle = article.IDArticle
        join sd_articletypes articletype on articletype.IDArticleType = article.IDArticleType
        join sd_masterzallocs alloc on article.IDZAlloc = alloc.IDZAlloc
        where po.IDPO = '".$idpo."'");
    }
    
    public function getTrxPO(){
        return DB::select("SELECT * FROM sd_trxpos");
    }

    public function getArticleType(){
        return DB::select("SELECT * FROM sd_articletypes WHERE updated_at is null");
    }

    public function getSuppliers(){
        return DB::select("SELECT * FROM sd_mastersuppliers WHERE updated_at is null");
    }

    public function createPO($req){
        try {
            DB::insert("INSERT INTO `sd_trxpos`(`id`, `IDPO`, `IDSupplier`, `IDArticle`, `Harga`, `ExchangeRate`, `TglJatuhTempo`, `Note`, `IDUser`, `created_at`, `updated_at`) 
                VALUES (NULL,'".$req['IDPO']."','".$req['IDSupplier']."','".$req['IDArticle']."','".$req['Harga']."','".$req['ExchangeRate']."','".$req['TglJatuhTempo']."','".$req['Note']."','".$req['IDUser']."', NOW(),NULL,'".$req['NotaSupplier']."','".$req['KodeBarangSupplier']."')");
                return "";
        } catch(\Illuminate\Database\QueryException  $ex){ 
            return $ex->getMessage();
        }  
    }
}

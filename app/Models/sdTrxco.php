<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class sdTrxco extends Model
{
    use HasFactory;
    protected $fillable = [
            'IDCO',
            'IDOrderType',
            'IDCustomer',
            'IDOrderType',
            'HargaFinal',
            'Note',
            'IDUser',
            'updated_at'
    ];

    public function getCOnow(){
        return DB::select("SELECT co.IDCO, cotype.NamaJenisType, CONCAT(customer.IDCustomer,' ',customer.Nama) as Customer, format(sum(co.HargaFinal),0) as TotalHarga, DATE_FORMAT(co.TglJatuhTempo, '%a, %d %b %Y') as TglJatuhTempo, DATE_FORMAT(co.created_at, '%a, %d %b %Y') as created_at, users.NamaUser as users from sd_trxcos co
        join sd_mastercustomers customer on co.IDCustomer = customer.id
        join users users on co.IDUser = users.id
        join sd_trxcotypes cotype on co.IDOrderType = cotype.id
        WHERE MONTH(co.created_at) = MONTH(NOW()) AND YEAR(co.created_at) = YEAR(NOW())
        group by co.IDCO
        order by co.created_at desc");
    }

    public function getCOfilter($request){
        $counter = 0;
        $query = "SELECT co.IDCO, cotype.NamaJenisType, CONCAT(customer.IDCustomer,' ',customer.Nama) as Customer, format(sum(co.HargaFinal),0) as TotalHarga, DATE_FORMAT(co.TglJatuhTempo, '%a, %d %b %Y') as TglJatuhTempo, DATE_FORMAT(co.created_at, '%a, %d %b %Y') as created_at, users.NamaUser as users from sd_trxcos co
        join sd_mastercustomers customer on co.IDCustomer = customer.id
        join users users on co.IDUser = users.id
        join sd_trxcotypes cotype on co.IDOrderType = cotype.id
        WHERE ";
        if($request->idco != ""){
            $query = $query."co.IDCO >= '".$request->idco."'";
            $counter++;
        }
        if($request->codateawal != ""){
            if($counter != 0){
                $query = $query." and ";
            }
            $query = $query."co.created_at >= '".$request->codateawal."'";
            $counter++;
        }
        if($request->codateakhir != ""){
            if($counter != 0){
                $query = $query." and ";
            }
            $query = $query."co.created_at <= '".$request->codateakhir."'";
            $counter++;
        }
        if($request->duedateawal != ""){
            if($counter != 0){
                $query = $query." and ";
            }
            $query = $query."co.TglJatuhTempo >= '".$request->duedateawal."'";
            $counter++;
        }
        if($request->duedateakhir != ""){
            if($counter != 0){
                $query = $query." and ";
            }
            $query = $query."co.TglJatuhTempo <= '".$request->duedateakhir."'";
            $counter++;
        }
        if($request->customer != ""){
            if($counter != 0){
                $query = $query." and ";
            }
            $query = $query."co.IDSupplier <= '".$request->customer."'";
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
        group by co.IDCO";
        return DB::select($query);
    }

    public function getCODetailHeader($idco){
        return DB::select("SELECT co.IDCO, cotype.NamaJenisType, CONCAT(customer.IDCustomer,' ',customer.Nama) as Customer, format(sum(co.HargaFinal),0) as TotalHarga, DATE_FORMAT(co.TglJatuhTempo, '%a, %d %b %Y') as TglJatuhTempo, DATE_FORMAT(co.created_at, '%a, %d %b %Y') as created_at, users.NamaUser as users from sd_trxcos co
        join (SELECT * FROM sd_mastercustomers WHERE updated_at is NULL) customer on co.IDCustomer = customer.id
        join users users on co.IDUser = users.id
        join sd_trxcotypes cotype on co.IDOrderType = cotype.id
        where co.IDCO = '".$idco."'");
    }

    public function getCODetail($idco){
            return DB::select("SELECT co.HargaFinal, co.Size, co.Weight, co.MetalType, co.Quality, co.LaborCost, co.GoldPrice, co.Note, coimage.Path from sd_trxcos co
            join sd_trxcoimages coimage on co.id = coimage.IDCO
        where co.IDCO = '".$idco."'");
    }

    public function getCOByKode($kode){
        return DB::select("SELECT DATE_FORMAT(co.created_at, '%Y-%m-%d') as created_at, co.IDCO, DATE_FORMAT(co.TglJatuhTempo, '%Y-%m-%d') as duedate, cotype.NamaJenisType, customer.Nama, customer.Telepon, customer.Alamat, coimage.Path, format(co.HargaFinal,0) as HargaFinal, co.Size, co.Weight, co.MetalType, co.Quality, co.LaborCost, co.GoldPrice, SUM(co.HargaFinal) as totalharga, COUNT(co.IDCO) as jumlahco, co.Note from sd_trxcos co
        join (SELECT * FROM sd_mastercustomers WHERE updated_at is NULL) customer on customer.id = co.IDCustomer
        join sd_trxcotypes cotype on cotype.id = co.IDOrderType
        join sd_trxcoimages coimage on coimage.IDCO = co.id
        where co.IDCO = '".$kode."'
        group by co.id");
    }

    public function getallco(){
        return DB::select("select a.*, SUM(a.HargaFinal) as TotalHarga, c.Nama as NamaCustomer, b.NamaUser as CreatedBy, c.IDCustomer from sd_trxcos a join users b on a.IDUser = b.id join sd_mastercustomers c on a.IDCustomer = c.id group by a.IDCO");
    }

    public function getidco($idco){
        return DB::select("select a.*, b.Path from sd_trxcos a join sd_trxcoimages b on a.id = b.IDCO where a.IDCO = '".$idco."'");
    }

    public function getCustomer(){
        return DB::select("SELECT * FROM sd_mastercustomers WHERE updated_at is null");
    }

    public function getCOType(){
        return DB::select("SELECT * FROM sd_trxcotypes WHERE updated_at is null");
    }

}

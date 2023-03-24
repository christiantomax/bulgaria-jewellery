<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class sdMastercustomer extends Model
{
    use HasFactory;

    public function getCustomer(){
        return DB::select("SELECT *, DATE_FORMAT(TanggalLahir, '%d/%m/%Y') BirthDate 
            FROM sd_mastercustomers WHERE updated_at is NULL ORDER BY IDCustomer");
    }

    public function getCustomerByID($idc){
        return DB::select("SELECT a.*, CONCAT('(', b.KodeUser,') ', b.NamaUser) as Maker,
        DATE_FORMAT(a.TanggalLahir, '%d/%m/%Y') BirthDate
        from sd_mastercustomers a, users b 
        WHERE a.IDUser = b.id AND a.id = ".$idc." AND a.updated_at is NULL");
    }

    public function getCustomerByCode($idc){
        return DB::select("SELECT a.*, CONCAT('(', b.KodeUser,') ', b.NamaUser) as Maker,
        DATE_FORMAT(a.TanggalLahir, '%d/%m/%Y') BirthDate
        from sd_mastercustomers a, users b 
        WHERE a.IDUser = b.id AND a.IDCustomer = '".$idc."' AND a.updated_at is NULL");
    }

    public function createCustomer($req){
        $nos_model = new sdNoseries;
        $nos = '';
        $nos = $nos_model->returnNoCustomer('CUS');
        $birthdate = "";
        if($req['lahir'] != ""){
            $birthdate = date_format(date_create_from_format('d/m/Y', $req['lahir']),"Y-m-d");
        }

        try {
            DB::insert("INSERT INTO `sd_mastercustomers`(`id`, `IDCustomer`, `Nama`, `Telepon`, `Telepon2`, `Email`, 
            `Alamat`, `TanggalLahir`, `Note`, `IDUser`, `IDUserUpdated`, `created_at`, `updated_at`) 
                VALUES (NULL,?,?,?,?,?,?,?, '',?,0,NOW(),NULL)",
                [$nos, $req['nama'], $req['telepon'], $req['telepon2'], $req['email'], $req['alamat'], $birthdate, Auth::user()->id]);
                return $nos;
        } catch(\Illuminate\Database\QueryException  $ex){ 
            $nos_model->returnNoTglCancel('CUS');
            return $ex->getMessage();
            return 'error';
        }  
    }
    
    public function updateCustomer($req){
        $birthdate = date_format(date_create_from_format('d/m/Y', $req['lahir']),"Y-m-d");

        try {
            DB::update("UPDATE sd_mastercustomers SET `updated_at` = '".NOW()."', `note` = '".$req['note']."' WHERE id = '".$req['idc']."'");
        } catch(\Illuminate\Database\QueryException  $ex){ 
            return "error";
        }

        try {
            DB::insert("INSERT INTO `sd_mastercustomers`(`id`, `IDCustomer`, `Nama`, `Telepon`, `Telepon2`, `Email`, 
            `Alamat`, `TanggalLahir`, `Note`, `IDUser`, `created_at`, `updated_at`) 
                VALUES (NULL,'".$req['kode']."','".$req['nama']."','".$req['telepon']."','".
                $req['telepon2']."','".$req['email']."','".$req['alamat']."', '".$birthdate."', '".$req['note']."',".Auth::user()->id.",'".NOW()."',NULL)");
                return 'berhasil';
        } catch(\Illuminate\Database\QueryException  $ex){ 
            return 'error';
        }  
    }

    public function delCustomer($req){
        try {
            DB::update("UPDATE sd_mastercustomers SET `updated_at` = '".NOW()."', `note` = '".$req['note']."' WHERE id = '".$req['idc']."'");
        } catch(\Illuminate\Database\QueryException  $ex){ 
            return "error";
        }
    }

    protected $fillable = [
        'IDCustomer',
            'Nama',
            'Telepon',
            'Telepon2',
            'Email',
            'Alamat',
            'TanggalLahir',
            'Note',
            'IDUser',
            'IDUserUpdated',
            'updated_at',
    ];
}

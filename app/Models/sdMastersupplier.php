<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class sdMastersupplier extends Model
{
    use HasFactory;

    public function getSupplier(){
        return DB::select("SELECT * FROM sd_mastersuppliers where updated_at is NULL");
    }

    public function getSupplierByCode($kodeuser){
        return DB::select("SELECT a.*, CONCAT('(', b.KodeUser,') ', b.NamaUser) as Maker
        from sd_mastersuppliers a, users b 
        WHERE a.IDUser = b.id AND a.id = '".$kodeuser."' ");
    }

    public function createSupplier($req){
        $nos_model = new sdNoseries;
        $nos = '';
        $nos = $nos_model->returnNoSupplier('SUP');

        try {
            DB::insert("INSERT INTO `sd_mastersuppliers`(`id`, `IDSupplier`, `Kode`, `Nama`, `Telepon`, `Telepon2`, `Email`, 
            `Alamat`, `Note`, `IDUser`, `IDUserUpdated`, `created_at`, `updated_at`) 
                VALUES (NULL,?,?,?,?,?,?,?, '',?,0,NOW(),NULL)",
                [$nos, $req['kode'], $req['nama'], $req['telepon'], $req['telepon2'], $req['email'], $req['alamat'], Auth::user()->id]);
                return $nos;
        } catch(\Illuminate\Database\QueryException  $ex){ 
            $nos_model->returnNoTglCancel('SUP');
            // return 'error';
            return $ex->getMessage();
        }  
    }

    public function updateSupplier($req){
        try {
            DB::update("UPDATE sd_mastersuppliers SET `updated_at` = '".NOW()."' WHERE id = '".$req['idu']."'");
        } catch(\Illuminate\Database\QueryException  $ex){ 
            return "error";
            // return $ex->getMessage();
        }

        try {
            DB::insert("INSERT INTO `sd_mastersuppliers`(`id`, `IDSupplier`, `Kode`, `Nama`, `Telepon`, `Telepon2`, `Email`, 
            `Alamat`, `Note`, `IDUser`, `created_at`, `updated_at`) 
                VALUES (NULL,'".$req['idsupplier']."','".$req['kode']."','".$req['nama']."','".$req['telepon']."','".
                $req['telepon2']."','".$req['email']."','".$req['alamat']."', '".$req['note']."',".Auth::user()->id.",'".NOW()."',NULL)");
            $lastID = DB::table('sd_mastersuppliers')->latest('id')->pluck('id')->first();
            $lastID = $lastID;
            DB::update("UPDATE sd_trxpos SET `IDSupplier` = ".$lastID.", note = concat(note, ' SupID".$lastID."') WHERE IDSupplier  = '".$req['idu']."'");
            return 'berhasil';
        } catch(\Illuminate\Database\QueryException  $ex){ 
            return $ex->getMessage();
            return 'error';
        }  
    }

    public function delSupplier($req){
        try {
            DB::update("UPDATE sd_mastersuppliers SET `updated_at` = '".NOW()."', `note` = '".$req['note']."' WHERE id = '".$req['idu']."'");
            return "UPDATE sd_mastersuppliers SET `updated_at` = '".NOW()."', `note` = '".$req['note']."' WHERE id = '".$req['idu']."'";
        } catch(\Illuminate\Database\QueryException  $ex){ 
            // return "error";
            return $ex->getMessage();
        }
    }

    protected $fillable = [
        'IDSupplier',
            'Nama',
            'Telepon',
            'Telepon2',
            'Email',
            'Alamat',
            'Note',
            'IDUser',
            'IDUserUpdated',
            'updated_at',
    ];
}

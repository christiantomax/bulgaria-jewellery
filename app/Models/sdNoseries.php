<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class sdNoseries extends Model
{
    use HasFactory;

    public function returnNoTgl($kode){
        $nos = '';
        $nos_db = DB::select("SELECT * FROM sd_noseries WHERE KodeNos = '".$kode."'");
        $nos = $nos_db[0]->KodeNos.$nos_db[0]->KodeToko."-";
        $urutan = str_pad($nos_db[0]->Urutan+1, 3, "0", STR_PAD_LEFT);
        $nos = $nos.$urutan;

        // Update urutan
        DB::update("UPDATE sd_noseries SET Urutan = ?, updated_at = NOW() WHERE KodeNos = ?",
            [$nos_db[0]->Urutan+1, $kode]);
        return $nos;
    }

    public function returnNoTglCancel($kode){
        DB::update("UPDATE sd_noseries SET Urutan = Urutan - 1, updated_at = NOW() WHERE KodeNos = '".$kode."'");
    }

    public function returnNoSo($kode, $tanggal, $keterangan){
        $nos = '';
        $datanos = DB::select("SELECT * FROM sd_noseries WHERE KodeNos = ? 
            AND (? BETWEEN TanggalMulai AND TanggalAkhir)", [$kode, $tanggal]);

        // Cek ada no series di range tanggal tersebut
        if(count($datanos) != 0){
            $nos = $datanos[0]->KodeToko.$datanos[0]->KodeNos."-"
                    .substr(date('Y', strtotime($datanos[0]->TanggalMulai)),2,2)
                    .date('m', strtotime($datanos[0]->TanggalMulai))
                    .substr($tanggal,-2,2)."-"
                    .str_pad($datanos[0]->Urutan+1,5,"0",STR_PAD_LEFT);
            return $nos;
        }else{
            $tanggalawal = substr($tanggal,0,8).'01';
            $keterangan = $keterangan." ".substr($tanggal,0,4)." ".substr($tanggal,5,2);
            
            // Create record baru kalau ga ada lalu rekursi supaya masuk dalam scope if
            DB::insert("INSERT INTO `sd_noseries`(`IDNos`, `KodeToko`, `KodeNos`, `Urutan`, `Keterangan`, `TanggalMulai`, `TanggalAkhir`, `created_at`, `updated_at`) VALUES 
                (NULL,'01',?,0,?,?,LAST_DAY(?),NOW(),NOW())",[$kode, $keterangan, $tanggalawal, $tanggal]);
            return $this->returnNoSo($kode, $tanggal, $keterangan);
        }
    }

    public function returnNoSoUpdate($kode, $tanggal){
        DB::update("UPDATE sd_noseries SET Urutan = Urutan + 1, updated_at = NOW() WHERE KodeNos = ?
            AND (? BETWEEN TanggalMulai AND TanggalAkhir)",[$kode, $tanggal]);
    }
    
    public function returnNoBB($kode, $tanggal, $keterangan){
        $nos = '';
        $datanos = DB::select("SELECT * FROM sd_noseries WHERE KodeNos = ? 
            AND (? BETWEEN TanggalMulai AND TanggalAkhir)", [$kode, $tanggal]);

        // Cek ada no series di range tanggal tersebut
        if(count($datanos) != 0){
            $nos = $datanos[0]->KodeToko.$datanos[0]->KodeNos."-"
                    .substr(date('Y', strtotime($datanos[0]->TanggalMulai)),2,2)
                    .date('m', strtotime($datanos[0]->TanggalMulai))
                    .substr($tanggal,-2,2)."-"
                    .str_pad($datanos[0]->Urutan+1,5,"0",STR_PAD_LEFT);
            return $nos;
        }else{
            $tanggalawal = substr($tanggal,0,8).'01';
            $keterangan = $keterangan." ".substr($tanggal,0,4)." ".substr($tanggal,5,2);
            
            // Create record baru kalau ga ada lalu rekursi supaya masuk dalam scope if
            DB::insert("INSERT INTO `sd_noseries`(`IDNos`, `KodeToko`, `KodeNos`, `Urutan`, `Keterangan`, `TanggalMulai`, `TanggalAkhir`, `created_at`, `updated_at`) VALUES 
                (NULL,'01',?,0,?,?,LAST_DAY(?),NOW(),NOW())",[$kode, $keterangan, $tanggalawal, $tanggal]);
            return $this->returnNoBB($kode, $tanggal, $keterangan);
        }
    }

    public function returnNoBBUpdate($kode, $tanggal){
        DB::update("UPDATE sd_noseries SET Urutan = Urutan + 1, updated_at = NOW() WHERE KodeNos = ?
            AND (? BETWEEN TanggalMulai AND TanggalAkhir)",[$kode, $tanggal]);
    }

    public function returnNoCustomer($kode){
        $nos = '';
        $nos_db = DB::select("SELECT * FROM sd_noseries WHERE KodeNos = '".$kode."'");
        $nos = $nos_db[0]->KodeToko."-";
        $urutan = str_pad($nos_db[0]->Urutan+1, 8, "0", STR_PAD_LEFT);
        $nos = $nos.$urutan;

        // Update urutan
        DB::update("UPDATE sd_noseries SET Urutan = ?, updated_at = NOW() WHERE KodeNos = ?",
            [$nos_db[0]->Urutan+1, $kode]);
        return $nos;
    }

    public function returnNoSupplier($kode){
        $nos = '';
        $nos_db = DB::select("SELECT * FROM sd_noseries WHERE KodeNos = '".$kode."'");
        $nos = $nos_db[0]->KodeToko."-";
        $urutan = str_pad($nos_db[0]->Urutan+1, 4, "0", STR_PAD_LEFT);
        $nos = $nos.$urutan;

        // Update urutan
        DB::update("UPDATE sd_noseries SET Urutan = ?, updated_at = NOW() WHERE KodeNos = ?",
            [$nos_db[0]->Urutan+1, $kode]);
        return $nos;
    }

    public function returnNoPO($kode){
        $nos = '';
        $today = date("ymd"); 
        $nos_db = DB::select("SELECT * FROM sd_noseries WHERE KodeNos = '".$kode."' and TanggalAkhir >= '".date("Y-m-d h:i:sa")."'");
        if(count($nos_db) != 0){
            $nos = $nos_db[0]->KodeToko."P-".$today."-";
            $urutan = str_pad($nos_db[0]->Urutan+1, 5, "0", STR_PAD_LEFT);
            $nos = $nos.$urutan;

            // Update urutan
            DB::update("UPDATE sd_noseries SET Urutan = ?, updated_at = NOW() WHERE KodeNos = ? AND TanggalAkhir >= ?",
            [$nos_db[0]->Urutan+1, $kode, date("Y-m-d h:i:sa")]);
    
        }else{
            DB::insert("INSERT INTO `sd_noseries`(`IDNos`, `KodeToko`, `KodeNos`, `Urutan`, `Keterangan`, `TanggalMulai`, `TanggalAkhir`, `created_at`, `updated_at`) VALUES 
                (NULL,'01',?,1,?,?,?,NOW(),NOW())",[$kode, "PO (Purchase Order)", date("Y-m-01 h:i:sa"), date("Y-m-t")]);
            $nos = "01P-".$today."-".str_pad(1, 5, "0", STR_PAD_LEFT);
        }
        return $nos;
    }

    public function returnNoCOI($kode){
        $nos = '';
        $today = date("ymd"); 
        $nos_db = DB::select("SELECT * FROM sd_noseries WHERE KodeNos = '".$kode."' and TanggalAkhir >= '".date("Y-m-d h:i:sa")."'");

        if(count($nos_db) != 0){
            $nos = "COI-".$today."-";
            $urutan = str_pad($nos_db[0]->Urutan+1, 5, "0", STR_PAD_LEFT);
            $nos = $nos.$urutan;
            
            // // Update urutan
            DB::update("UPDATE sd_noseries SET Urutan = ?, updated_at = NOW() WHERE KodeNos = ?",
            [$nos_db[0]->Urutan+1, $kode]);
        }else{
            DB::insert("INSERT INTO `sd_noseries`(`IDNos`, `KodeToko`, `KodeNos`, `Urutan`, `Keterangan`, `TanggalMulai`, `TanggalAkhir`, `created_at`, `updated_at`) VALUES 
                (NULL,'01',?,1,?,?,?,NOW(),NOW())",[$kode, "COI (Custom Order Image)", date("Y-m-01 h:i:sa"), date("Y-m-t")]);
            $nos = "COI-".$today."-".str_pad(1, 5, "0", STR_PAD_LEFT);
        }
        return $nos;
    }

    public function returnNoCO($kode){
        $nos = '';
        $today = date("ymd"); 
        $nos_db = DB::select("SELECT * FROM sd_noseries WHERE KodeNos = '".$kode."' and TanggalAkhir >= '".date("Y-m-d h:i:sa")."'");

        if(count($nos_db) != 0){
            $nos = $nos_db[0]->KodeToko."C-".$today."-";
            $urutan = str_pad($nos_db[0]->Urutan+1, 5, "0", STR_PAD_LEFT);
            $nos = $nos.$urutan;
            
            // // Update urutan
            DB::update("UPDATE sd_noseries SET Urutan = ?, updated_at = NOW() WHERE KodeNos = ?",
            [$nos_db[0]->Urutan+1, $kode]);
        }else{
            DB::insert("INSERT INTO `sd_noseries`(`IDNos`, `KodeToko`, `KodeNos`, `Urutan`, `Keterangan`, `TanggalMulai`, `TanggalAkhir`, `created_at`, `updated_at`) VALUES 
                (NULL,'01',?,1,?,?,?,NOW(),NOW())",[$kode, "CO (Custom Order)", date("Y-m-01 h:i:sa"), date("Y-m-t")]);
            $nos = "01C-".$today."-".str_pad(1, 5, "0", STR_PAD_LEFT);
        }
        return $nos;
    }

    public function returnNoAgenda($kode){
        $nos = '';
        $today = date("ymd"); 
        $nos_db = DB::select("SELECT * FROM sd_noseries WHERE KodeNos = '".$kode."' and TanggalAkhir >= '".date("Y-m-d h:i:sa")."'");

        if(count($nos_db) != 0){
            $nos = $nos_db[0]->KodeToko."A-".$today."-";
            $urutan = str_pad($nos_db[0]->Urutan+1, 5, "0", STR_PAD_LEFT);
            $nos = $nos.$urutan;
            
            // // Update urutan
            DB::update("UPDATE sd_noseries SET Urutan = ?, updated_at = NOW() WHERE KodeNos = ?",
            [$nos_db[0]->Urutan+1, $kode]);
        }else{
            DB::insert("INSERT INTO `sd_noseries`(`IDNos`, `KodeToko`, `KodeNos`, `Urutan`, `Keterangan`, `TanggalMulai`, `TanggalAkhir`, `created_at`, `updated_at`) VALUES 
                (NULL,'01',?,1,?,?,?,NOW(),NOW())",[$kode, "CO (Custom Order)", date("Y-m-01 h:i:sa"), date("Y-m-t")]);
            $nos = "01A-".$today."-".str_pad(1, 5, "0", STR_PAD_LEFT);
        }
        return $nos;
    }

    public function returnNoArticle($kode){
        $nos = '';
        $nos_db = DB::select("SELECT * FROM sd_noseries WHERE KodeNos = '".$kode."'");
        $urutan = str_pad($nos_db[0]->Urutan+1, 4, "0", STR_PAD_LEFT);
        $nos = $nos.$urutan;

        // Update urutan
        DB::update("UPDATE sd_noseries SET Urutan = ?, updated_at = NOW() WHERE KodeNos = ?",
            [$nos_db[0]->Urutan+1, $kode]);
        return $kode.$nos;
    }

    public function returnUserId(){
        return Auth::user()->id;
    }


    protected $fillable = [
        'KodeToko',
        'KodeNos',
        'Urutan',
        'Keterangan',
        'TanggaMulai',
        'TanggaAkhir',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class sdMutation extends Model
{
    use HasFactory;

    public function createMutation($docno, $idart, $kodeart, $namart, $idfrom, $namafrom, $idto, $namato, $note){
        try {
            $this::create([
                'DocumentNo' => $docno,
                'IDArticle' => $idart,
                'KodeArticle' => $kodeart,
                'NamaArticle' => $namart,
                'IDZAllocFrom' => $idfrom,
                'NamaAllocFrom' => $namafrom,
                'IDZAllocTo' => $idto,
                'NamaAllocTo' => $namato,
                'IDUser' => Auth::user()->id,
                'NamaUser' => Auth::user()->NamaUser,
                'Note' => $note,
            ]);
            
            $artModel = new sdMasterarticle;
            $artModel->updateArticleAlloc($idto, $idart);
            
            return 'berhasil';
        } catch(\Illuminate\Database\QueryException $ex){ 
            return 'error';
        }
    }

    public function getMutationList($awal, $akhir){
        if($awal == "" || $akhir == ""){
            return DB::select("SELECT * FROM `sd_mutations` WHERE DATE(created_at) BETWEEN 
                    DATE(SUBDATE(NOW(), INTERVAL 1 week)) AND DATE(NOW())");
        }else{
            $bgn = date_format(date_create($awal),"Y-m-d");
            $end = date_format(date_create($akhir),"Y-m-d");
            return DB::select("SELECT * FROM `sd_mutations` WHERE 
                                cast(created_at as date) BETWEEN '".$bgn."' AND '".$end."'");
        }
    }

    protected $fillable = [
        'DocumentNo',
        'IDArticle',
        'KodeArticle',
        'NamaArticle',
        'IDZAllocFrom',
        'NamaAllocFrom',
        'IDZAllocTo',
        'NamaAllocTo',
        'IDUser',
        'NamaUser',
        'Note',
    ];
}

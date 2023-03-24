<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\sdNoSeries;

class sdArticletype extends Model
{
    use HasFactory;

    public function getType(){
        return DB::select("SELECT at.*, DATE(at.updated_at) updated_at, u.NamaUser 
            FROM sd_articletypes at JOIN users u ON at.IDUser = u.id ORDER BY IDArticleType");
    }
    
    public function getTypeByCodeByIDArticleType($kode){
        return DB::select("SELECT at.*, u.id, u.KodeUser, u.NamaUser
            FROM sd_articletypes at JOIN users u
            ON at.IDUser = u.id WHERE KodeAwal = '".$kode."'");
    }

    public function delArType($req){
        try {
            $this::where('IDArticleType',$req['ida'])->delete();
            sdNoSeries::where('KodeNos',$req['kode'])->delete();
            return 'berhasil';
        } catch(\Illuminate\Database\QueryException $ex){ 
            return 'error';
        }
    }

    public function updateArType($req){
        try {
            DB::table('sd_articletypes')
                ->where('IDArticleType', $req['ida'])
                ->update([
                    'NamaJenisArticle' => $req['nama'],
                    'Note' => $req['note'],
                    'IDUser' => Auth::user()->id,
                ]);
            return 'berhasil';
        } catch(\Illuminate\Database\QueryException $ex){ 
            return 'error';
        }
    }

    public function createArType($req){
        try {
            $this::create([
                'KodeAwal' => $req['kode'],
                'NamaJenisArticle' => $req['nama'],
                'Note' => $req['note'],
                'IDUser' => Auth::user()->id,
                'updated_at' => NULL,
            ]);
            sdNoSeries::create([
                'KodeToko' => '01',
                'KodeNos' => $req['kode'],
                'Urutan' => 8000,
                'Keterangan' => $req['nama'],
                'TanggalMulai' => '2021-10-01',
                'TanggalAkhir' => '2021-10-01',
            ]);
            return 'berhasil';
        } catch(\Illuminate\Database\QueryException $ex){ 
            return 'error';
        }
    }

    protected $fillable = [
        'KodeAwal',
        'NamaJenisArticle',
        'Note',
        'IDUser',
        'updated_at'
    ];
}

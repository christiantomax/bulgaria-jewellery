<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class sdMasterzalloc extends Model
{
    use HasFactory;

    public function getType(){
        return DB::select("SELECT st.*, DATE(st.updated_at) updated_at, u.NamaUser 
            FROM sd_masterzallocs st JOIN users u ON st.IDUser = u.id");
    }

    public function getTypePo(){
        return DB::select("SELECT st.*, DATE(st.updated_at) updated_at, u.NamaUser 
            FROM sd_masterzallocs st JOIN users u ON st.IDUser = u.id where st.IDZAlloc NOT IN (3)");
    }

    public function getTypeByCode($kode){
        return DB::select("SELECT st.*, DATE(st.updated_at) updated_at, u.KodeUser, u.NamaUser 
            FROM sd_masterzallocs st JOIN users u
            ON st.IDUser = u.id WHERE KodeAlloc = '".$kode."'");
    }

    public function getTypeByID($id){
        return DB::select("SELECT st.*, DATE(st.updated_at) updated_at, u.KodeUser, u.NamaUser 
            FROM sd_masterzallocs st JOIN users u
            ON st.IDUser = u.id WHERE st.IDZAlloc = ".$id);
    }

    public function getSummary($idalloc){
        if($idalloc == "all")
            return DB::select("SELECT atp.IDArticleType, atp.KodeAwal, atp.NamaJenisArticle, COUNT(ma.IDArticleType) Jumlah
                FROM sd_articletypes atp JOIN sd_masterarticles ma ON (atp.IDArticleType = ma.IDArticleType)
                GROUP BY atp.IDArticleType, atp.KodeAwal, atp.NamaJenisArticle");
        return DB::select("SELECT atp.IDArticleType, atp.KodeAwal, atp.NamaJenisArticle, COUNT(ma.IDArticleType) Jumlah
            FROM sd_articletypes atp JOIN sd_masterarticles ma ON (atp.IDArticleType = ma.IDArticleType)
            WHERE ma.IDZAlloc = ?
            GROUP BY atp.IDArticleType, atp.KodeAwal, atp.NamaJenisArticle",[$idalloc]);
    }

    public function delAlloc($req){
        try {
            $this::where('IDZAlloc',$req['ida'])->delete();
            return 'berhasil';
        } catch(\Illuminate\Database\QueryException $ex){ 
            return 'error';
        }
    }

    public function updateAlloc($req){
        try {
            $this::where('IDZAlloc', $req['ida'])
                    ->update([
                        'NamaAlloc' => $req['nama'],
                        'Note' => $req['note'],
                        'IDUser' => Auth::user()->id,
                    ]);
            return 'berhasil';
        } catch(\Illuminate\Database\QueryException $ex){ 
            return 'error';
        }
    }

    public function createAlloc($req){
        try {
            $this::create([
                'KodeAlloc' => $req['kode'],
                'NamaAlloc' => $req['nama'],
                'Note' => $req['note'],
                'IDUser' => Auth::user()->id,
            ]);
            return 'berhasil';
        } catch(\Illuminate\Database\QueryException $ex){ 
            return 'error';
        }
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

    protected $fillable = [
        'KodeAlloc',
        'NamaAlloc',
        'Note',
        'IDUser',
    ];
}

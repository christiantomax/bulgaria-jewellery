<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class sdMasterarticleimage extends Model
{
    use HasFactory;

    public function articleImage($id, $nama, $path){
        $data = DB::select("SELECT * FROM sd_masterarticleimages WHERE IDArticle = ".$id);

        if(count($data) == 0){
            DB::insert("INSERT INTO `sd_masterarticleimages`(`id`, `IDArticle`, `Name`, `Path`, `Note`, `IDUser`, `created_at`, `updated_at`) VALUES 
                        (NULL,".$id.",'".$nama."','".$path."','','".Auth::user()->id."',NOW(),NOW())");
        }else{
            DB::update("UPDATE `sd_masterarticleimages` SET `Name` = '".$nama."', `Path` = '".$path."', 
                    `IDUser` = ".Auth::user()->id." WHERE `IDArticle` = ".$id);
        }
    }

    protected $fillable = [
         'IDArticle', 'Name', 'Path', 'Note', 'IDUser'
    ];

}

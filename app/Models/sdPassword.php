<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class sdPassword extends Model
{
    use HasFactory;

    public function getPass(){
        return DB::select("SELECT * FROM sd_passwords");
    }

    public function changePass($newpass){
        return DB::update("UPDATE users SET password = ? WHERE id = ?",
            [$newpass, Auth::user()->id]);
    }
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\sdNoseries;
use App\Models\sdPassword;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public function getUser(){
        return DB::select("SELECT u.KodeUser, u.NamaUser, u.AlamatUser, u.username, 
        l.Level FROM users u JOIN sd_levels l ON u.IDLevel = l.IDLevel WHERE u.IDLevel <> 1 
        ORDER BY u.id");
    }
    
    public function getUserAll(){
        return DB::select("SELECT u.id, u.KodeUser, u.NamaUser, u.AlamatUser, u.username, 
        l.Level FROM users u JOIN sd_levels l ON u.IDLevel = l.IDLevel ORDER BY u.id");
    }

    public function getUserByCode($kodeuser){
        return DB::select("SELECT u.id, u.IDLevel, u.KodeUser, u.NamaUser, u.AlamatUser, DATE(u.updated_at) updated_at,
        u.username, u.Status, u.Note, l.Level, CONCAT('(', um.KodeUser,') ', um.NamaUser) as Maker 
        FROM users u JOIN sd_levels l ON u.IDLevel = l.IDLevel
        JOIN users um ON u.IDUserMaker = um.id
        WHERE u.IDLevel <> 1 AND u.KodeUser = '".$kodeuser."'");
    }

    public function getLevel(){
        return DB::select("SELECT * FROM sd_levels WHERE IDLevel <> 1");
    }

    public function resetPass($idu){
        try {
            $defpass = new sdPassword;
            $pass = $defpass->getPass();
            
            DB::update("UPDATE users SET `password` = ?, `IDUserMaker` = ?, `updated_at` = NOW() WHERE id = ?",
                [bcrypt($pass[0]->DefaultPassword), Auth::user()->id, $idu]);
            return 'berhasil';
        } catch(\Illuminate\Database\QueryException  $ex){ 
            return 'error';
        }
    }

    public function updateUser($req){
        try {
            DB::update("UPDATE users SET `IDLevel` = ?, `NamaUser` = ?, `AlamatUser` = ?,
                `username` = ?, `IDUserMaker` = ?, `Status` = ?, `Note` = ?, `updated_at` = NOW() WHERE id = ?",
                [$req['level'],$req['nama'],$req['alamat'], $req['username'],Auth::user()->id,$req['status'],
                $req['note'], $req['idu']]);
            return 'berhasil';
        } catch(\Illuminate\Database\QueryException  $ex){ 
            return 'error';
        }
    }

    public function delUser($req){
        try {
            DB::delete("DELETE FROM users WHERE id = ".$req);
            return 'berhasil';
        } catch(\Illuminate\Database\QueryException  $ex){ 
            return 'error';
        }
    }

    public function createUser($req){
        $nos_model = new sdNoseries;
        $nos = '-';
        if($req['level'] == 2)
            $nos = $nos_model->returnNoTgl('ADM');
        else if($req['level'] == 3)
            $nos = $nos_model->returnNoTgl('STD');

        try {
            $defpass = new sdPassword;
            $pass = $defpass->getPass();

            DB::insert("INSERT INTO `users`(`id`, `IDLevel`, `KodeUser`, `NamaUser`, `AlamatUser`, `username`, `password`, 
                `Status`, `Note`, `IDUserMaker`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) 
                VALUES (NULL,?,?,?,?,?,?, 1,'-',?,NULL,NULL,NOW(),NOW())",
                [$req['level'], $nos, $req['nama'], $req['alamat'], $req['username'], bcrypt($pass[0]->DefaultPassword), Auth::user()->id]);
            return $nos;
        } catch(\Illuminate\Database\QueryException  $ex){ 
            if($req['level'] == 2)
                $nos_model->returnNoTglCancel('ADM');
            else if($req['level'] == 3)
                $nos_model->returnNoTglCancel('STD');
            return 'error';
        }  
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'IDLevel',
        'KodeUser',
        'NamaUser',
        'AlamatUser',
        'username',
        'password',
        'Status',
        'Note',
        'IDUserMaker',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

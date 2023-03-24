<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sdTrxcotype extends Model
{
    use HasFactory;
    protected $fillable = [
         'NamaJenisType', 'Note', 'IDUser', 'updated_at'
    ];
}

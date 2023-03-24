<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sdTrxcoimage extends Model
{
    use HasFactory;
    protected $fillable = [
         'IDArticle', 'Name', 'Path', 'Note', 'IDUser'
    ];
}

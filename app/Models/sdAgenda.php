<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sdAgenda extends Model
{
    use HasFactory;
    protected $fillable = [
        'IDAgenda',
        'TglMulai',
        'JudulAgenda',
        'NoteAgenda',
        'Status',
        'IDUser',
        'updated_at'
    ];
}

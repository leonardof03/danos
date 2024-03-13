<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dano extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca', 'resposta_ai', 'fotos'  ];

    protected $casts = [
        'fotos' => 'array'
    ];
    
}

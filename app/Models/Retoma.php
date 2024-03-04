<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\OpenAIController;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Retoma extends Model
{
    use HasFactory;

    protected $fillable = [
        'marca', 'modelo', 'ano', 'quilometragem', 'descricao', 'fotos'
    ];

    protected $casts = [
        'fotos' => 'array'
    ];

  
}

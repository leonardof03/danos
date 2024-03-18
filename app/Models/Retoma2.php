<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retoma2 extends Model
{
    use HasFactory;

    protected $fillable = [
        'description', 
        'image_url', 
        'request_params',
    ];

    protected $casts = [
        'request_params' => 'array',
    ];

}

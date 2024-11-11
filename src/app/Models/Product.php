<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'season',
        'description',
        'image',
    ];

    protected $casts = [
        'season' => 'array', // JSONを配列として扱う
    ];
}
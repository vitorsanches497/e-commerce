<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Permite salvar esses campos em massa (segurança)
    protected $fillable = [
        'name',
        'description',
        'price',
        'image'
    ];

    // Converte o preço automaticamente para número
    protected $casts = [
        'price' => 'decimal:2'
    ];
}
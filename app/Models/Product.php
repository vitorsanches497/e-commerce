<?php

declare(strict_types=1);

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
        'discount_percentage',
        'promotion_active',
        'image',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Converte o preço automaticamente para número
    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function getFinalPriceAttribute(): float
    {
        if (! $this->promotion_active || $this->discount_percentage <= 0) {
            return (float) $this->price;
        }

        return round(
            $this->price - ($this->price * ($this->discount_percentage / 100)),
            2
        );
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}

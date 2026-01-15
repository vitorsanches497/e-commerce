<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cep',
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


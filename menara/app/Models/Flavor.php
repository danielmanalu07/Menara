<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'flavor_id', 'id');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'image',
        'name',
        'price',
        'description',
        'category_id',
        'flavor_id',
    ];

    public function catagory()
    {
        return $this->belongsTo(Category::class, 'id');
    }

    public function flavor()
    {
        return $this->belongsTo(Flavor::class, 'id');
    }
}

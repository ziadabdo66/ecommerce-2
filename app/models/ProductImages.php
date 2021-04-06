<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $table='product_images';
    protected $fillable = [
        'photo'
    ];
}

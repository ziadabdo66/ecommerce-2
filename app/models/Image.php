<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table='images';
    protected $guarded = [];
    public function getPhotoAttribute($value){
        return ($value!==null)?asset('assets/images/products/'.$value):"";
    }
}

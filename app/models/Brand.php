<?php

namespace App\models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Translatable;
    protected $with=['Translations'];
    public $translatedAttributes=['name'];
    protected $fillable=['brand_id','is_active','photo'];
    protected $hidden=['translations'];
    protected $casts=['is_active'=>'boolean'];
    public function getactive(){
        return $this->is_active==0?'غير مفعل':'مفعل';
    }
    public function getPhotoAttribute($value){
        return ($value!==null)?asset('assets/images/brands/'.$value):"";
    }
}

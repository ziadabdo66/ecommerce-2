<?php

namespace App\models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Translatable;
    protected $with=['Translations'];
    public $translatedAttributes=['name'];
    protected $fillable=['slug','is_active'];
    protected $hidden=['translations'];
    protected $casts=['is_active'=>'boolean'];
    public function getactive(){
        return $this->is_active==0?"غير مفعل":"مفعل";
    }
    public function scopeActive($query){
        return    $query->where('is_active',1);
    }
}

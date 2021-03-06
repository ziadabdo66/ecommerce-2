<?php

namespace App\models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;
    protected $with=['Translations'];
    public $translatedAttributes=['name'];
    protected $fillable=['parent_id','slug','is_active'];
    protected $hidden=['translations'];
    protected $casts=['is_active'=>'boolean'];
    public function scopeParent($query){
    return    $query->whereNull('parent_id');
    }
    public function scopeChild($query){
        return    $query->whereNotNull('parent_id');
    }
    public function scopeActive($query){
        return    $query->where('is_active',1);
    }
    public function getactive(){
       return $this-> is_active==0?"غير مفعل":"مفعل";
    }
    public function _parent(){
        return $this->belongsTo(self::class,'parent_id');
    }

    public function sub_category(){
        return $chiled=$this->hasMany(self::class,'parent_id');



    }
    public function cat_trans(){
        return $this->hasMany(CategoryTranslation::class,'category_id');
    }



}

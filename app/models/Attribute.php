<?php

namespace App\models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use Translatable;
    protected $with=['Translations'];
    public $translatedAttributes=['name'];
    protected $guarded=[];
    protected $hidden=['translations'];
    public function attribute_translation(){
        return $this->hasMany(AttributeTranslation::class,'attribute_id');
    }
    public function options(){
        return $this->hasMany(Option::class,'attribute_id');
    }


}

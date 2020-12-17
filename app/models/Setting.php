<?php

namespace App\models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use Translatable;
    protected $with=['Translations'];
    public $translatedAttributes=['value'];
    protected $guarded=[];
    protected $casts=['is_translatable'=>'boolean'];
    public static function setmany($setting){
foreach ($setting as $key=>$value){
    self::set($key,$value);
}
    }
    public static function set($key,$value){
        if($key ==='translatable'){
            return static::setTranslatableSettings($value);
        }
        if(is_array($value)){
            $value=json_encode($value);//if the key is array it cast it to text
        }

        static::updateOrCreate(['key'=>$key],['plan_value'=>$value]);
    }

    public static function setTranslatableSettings($setting=[]){
        foreach ($setting as $key=>$value){
            static::updateOrCreate(['key'=>$key],['is_translatable'=>true,'value'=>$value]);

        }

}
}

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
}

<?php

namespace App\models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use Translatable,SoftDeletes;
    protected $with=['Translations'];
    public $translatedAttributes=['name','description','short_description'];
    protected $fillable=[
        'brand_id',
        'slug',
        'price',
        'special_price',
        'special_price_type',
        'special_price_start',
        'special_price_end',
        'selling_price',
        'sku',
        'manage_stock',
        'qty',
        'in_stock',
        'viewed',
        'is_active'



    ];
   // protected $hidden=['translations'];
    protected $casts=[
        'is_active'=>'boolean',
        'manage_stock'=>'boolean',
        'in_stock'=>'boolean',
        ];
    protected $dates=[
        'special_price_start',
        'special_price_end',
        'start_date',
        'end_date',
        'deleted_at'

    ];
    public function getactive(){
        return $this->is_active==0?"غيرمفعل":"مفعل";
    }
    public function brand(){
        return $this->belongsTo(Brand::class)->withDefault();
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'product_categories');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tags');
    }
    public function options(){
        return $this->hasMany(Option::class,'product_id');
    }
    public function scopeActive($query){
        return $query->where('is_active',1);
    }
}

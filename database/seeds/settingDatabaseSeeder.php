<?php

use Illuminate\Database\Seeder;

class settingDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //setmany is method in model setting
\App\models\Setting::setmany([
   'default_locale'=>'ar',
   'default_timezone'=>'Africa\cairo',
   'reviews_enabled'=>true,
   'auto_approve_reviews'=>true,
   'supported_currencies'=>['USD','LE','Sar'],//coins
   'default_currency'=>'USD',
   'store_email'=>'admin@ecommerce.zzz',
   'search_engine'=>'mysql',
   'local_pickup_cost'=>0,
   'flat_rate_cost'=>0,
  'translatable'=>[
       'store_name'=>'FleetStore',
       'free_shipping_label'=>'Free shipping',
       'local_label'=>'Local shipping',
       'Outer_label'=>'Outer shipping',
   ]



]);
    }
}

<?php

use Illuminate\Database\Seeder;

class productDatabaseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(\App\models\Product::class,20)->create();

    }


}

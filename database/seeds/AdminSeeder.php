<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\models\Admin::create([
            'name'=>'adham',
            'email'=>'adham@yahoo.com',
            'password'=>bcrypt('12345678')
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class categoryDatabaseSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory(\App\models\Category::class,20)->create([
           'parent_id'=>$this->getRandomParentId(),
       ]);

    }

    private function getRandomParentId()
    {
        return \App\models\Category::inRandomOrder()->first();
    }
}

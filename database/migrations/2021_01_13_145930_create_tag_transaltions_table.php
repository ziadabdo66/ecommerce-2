<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagTransaltionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tag_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('tag_id')->unsigned();
            $table->string('locale');
            $table->string('name');
            $table->unique(['locale','tag_id']);
            $table->timestamps();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_translations');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->string('category')->default('tutorial');
            $table->string('api_route')->default('tutorials');
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->text('intro')->nullable();
            $table->string('image_src')->nullable();
            $table->string('slug');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutorials');
    }
}

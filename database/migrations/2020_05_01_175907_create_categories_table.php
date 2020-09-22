<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('category_name')->nullable();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('category_id')->default(0)->nullable();
            $table->unsignedBigInteger('thumbnail_id')->nullable();
            $table->string('icon_class')->nullable();
            $table->tinyInteger('step')->default(0);
            $table->tinyInteger('status')->default(1)->nullable(); //1= enable, 2=disable
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
        Schema::dropIfExists('categories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_states', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('country_id');
            $table->string('name', 255);
            $table->string('region', 255)->nullable();
            $table->string('iso_3166_2', 2)->nullable();
            $table->string('region_code', 10)->nullable();
            $table->string('calling_code', 5)->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });

//        Schema::table('tm_states', function (Blueprint $table) {
//            $table->foreign('country_id')
//                ->references('id')->on('tm_countries')
//                ->onDelete('cascade');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_states');
    }
}

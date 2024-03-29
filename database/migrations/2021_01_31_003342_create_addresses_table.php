<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->string('address');
            $table->string('postal_code');
            $table->string('phone')->nullable();
            $table->unsignedBigInteger('village_id')->nullable();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('country_id');

            $table->string('map_latitude')->nullable();
            $table->string('map_longitude')->nullable();
            $table->enum('type', ['billing', 'home', 'office', 'main'])->default('home');

            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('tm_countries')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('tm_states')->onDelete('cascade');
            $table->foreign('city_id')->references('id')->on('tm_cities')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('tm_districts')->onDelete('set null');
            $table->foreign('village_id')->references('id')->on('tm_villages')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}

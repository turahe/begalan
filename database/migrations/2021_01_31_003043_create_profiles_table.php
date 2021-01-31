<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('gender', 20)->nullable();
            $table->string('company_name')->nullable();
            $table->string('postcode')->nullable();
            $table->string('website')->nullable();
            $table->string('phone')->nullable();
            $table->text('about_me')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('photo')->nullable();
            $table->string('job_title')->nullable();
            $table->text('options')->nullable();
            $table->string('user_type')->nullable(); //['user', 'admin', 'support', 'sub_admin']
            $table->tinyInteger('active_status')->default(0)->nullable(); //active_status 0:pending, 1:active, 2:block;
            $table->timestamps();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('earnings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('instructor_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('payment_id');
            $table->string('payment_status')->nullable();
            $table->decimal('amount', 16);
            $table->decimal('instructor_amount', 16)->nullable();
            $table->decimal('admin_amount', 16)->nullable();

            $table->decimal('instructor_share', 16)->nullable();
            $table->decimal('admin_share', 16)->nullable();

            $table->timestamps();
        });

        Schema::table('earnings', function (Blueprint $table) {
            $table->foreign('instructor_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('earnings');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscussionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('content_id');
            $table->unsignedBigInteger('instructor_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('title');
            $table->text('message');
            $table->tinyInteger('replied')->default(0)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('discussions', function (Blueprint $table) {
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('set null');
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
            $table->foreign('instructor_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('parent_id')->references('id')->on('discussions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discussions');
    }
}

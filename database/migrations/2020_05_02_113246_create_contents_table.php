<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('section_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('text')->nullable();
            $table->text('video_src')->nullable();
            $table->integer('video_time')->nullable();
            $table->string('item_type', 30)->nullable();
            $table->tinyInteger('is_preview')->default(0)->nullable();
            $table->tinyInteger('status')->default(0)->nullable();
            $table->tinyInteger('sort_order')->default(0)->nullable();
            $table->text('options')->nullable();
            $table->tinyInteger('quiz_gradable')->nullable();
            $table->timestamp('unlock_date')->nullable();
            $table->tinyInteger('unlock_days')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('contents', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}

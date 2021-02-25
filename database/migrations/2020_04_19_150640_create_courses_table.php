<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');

            $table->string('title');
            $table->string('slug')->unique();
            $table->string('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->text('benefits')->nullable();
            $table->text('requirements')->nullable();
            $table->string('price_plan', 20)->nullable();

            $table->decimal('price', 16)->nullable();
            $table->decimal('sale_price', 16)->nullable();

            $table->tinyInteger('level')->default(0)->nullable();
            $table->tinyInteger('status')->default(0)->nullable(); //0:draft, 1:publish, 2:pending, 3:block, 4:unpublish

            $table->tinyInteger('is_presale')->default(0)->nullable();
            $table->timestamp('launch_at')->nullable();
            $table->unsignedBigInteger('thumbnail_id')->nullable();
            $table->text('video_src')->nullable();
            $table->unsignedBigInteger('total_video_time')->nullable();

            $table->unsignedBigInteger('require_enroll')->default(1)->nullable(); //if free
            $table->unsignedBigInteger('require_login')->default(1)->nullable(); // if free

            $table->tinyInteger('total_lectures')->default(0)->nullable();
            $table->tinyInteger('total_assignments')->default(0)->nullable();
            $table->tinyInteger('total_quiz')->default(0)->nullable();

            $table->tinyInteger('is_featured')->nullable();
            $table->timestamp('featured_at')->nullable();
            $table->tinyInteger('is_popular')->nullable();
            $table->timestamp('popular_added_at')->nullable();

            $table->timestamp('published_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}

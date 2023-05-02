<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id("course_id");
            $table->unsignedBigInteger("category_id");
            $table->unsignedBigInteger("professor_id");
            $table->string("course_title");
            $table->longText("course_content");
            $table->string("course_image");
            $table->string("difficulty");
            $table->tinyInteger("assignment");
            $table->integer('enrolled_students')->default(0);
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('professor_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

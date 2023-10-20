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
        Schema::create('discount_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assign_student_id');
            $table->unsignedBigInteger('student_fee_category_id')->nullable();
            $table->double('discount')->nullable();
            $table->foreign('assign_student_id')->references('id')->on('assign_students')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('student_fee_category_id')->references('id')->on('student_fee_categories')->onUpdate('cascade')->onDelete('cascade');   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_students');
    }
};

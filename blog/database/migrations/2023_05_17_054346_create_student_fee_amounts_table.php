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
        Schema::create('student_fee_amounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_class_id');
            $table->unsignedBigInteger('student_fee_category_id');
            $table->double('amount');
            $table->foreign('student_class_id')->references('id')->on('student_classes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('student_fee_category_id')->references('id')->on('student_fee_categories')->onUpdate('cascade')->onDelete('cascade');
           // $table->foreign('student_class_id')->references('id')->on('student_classes')->OnDelete('cascade');
           // $table->foreign('student_fee_category_id')->references('id')->on('student_fee_categories')->OnDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_fee_amounts');
    }
};

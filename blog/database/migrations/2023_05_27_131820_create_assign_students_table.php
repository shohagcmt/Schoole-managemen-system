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
        Schema::create('assign_students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id')->comment('user_id=student_id');
            $table->unsignedBigInteger('studentclass_id');
            $table->integer('roll')->nullable();
            $table->unsignedBigInteger('studentyear_id');
            $table->unsignedBigInteger('studentgroup_id')->nullable();
            $table->unsignedBigInteger('studentshift_id')->nullable();
            $table->foreign('studentclass_id')->references('id')->on('student_classes')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('studentyear_id')->references('id')->on('student_years')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('studentgroup_id')->references('id')->on('student_groups')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('studentshift_id')->references('id')->on('student_shifts')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assign_students');
    }
};

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
        Schema::create('meal_distributions', function (Blueprint $table) {
            $table->bigIncrements('distribution_id');
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('teacher_id'); // guru penanggung jawab
            $table->unsignedBigInteger('class_id');
            $table->date('meal_date');
            $table->enum('status', ['received', 'not_received'])->default('not_received');
            $table->timestamps();

            // Foreign keys
            $table->foreign('school_id')->references('school_id')->on('schools')->onDelete('cascade');
            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('class_id')->references('class_id')->on('classes')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');

            // Constraint: 1 siswa hanya bisa menerima 1 meal per tanggal
            $table->unique(['student_id', 'meal_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_distributions');
    }
};

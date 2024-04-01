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
        Schema::create('students_group', function (Blueprint $table) {
            $table->bigInteger('lecturer_id')->unsigned();
            $table->foreign('lecturer_id')
                  ->references('id')
                  ->on('lecturers')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_group');
    }
};

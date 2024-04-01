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
        Schema::create('lecturers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('birthday');
            $table->string('address');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            $table->bigInteger('department_id')->unsigned();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('position_id')->unsigned();
            $table->foreign('position_id')
                    ->references('id')
                    ->on('positions')
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
        Schema::dropIfExists('lecturers');
    }
};

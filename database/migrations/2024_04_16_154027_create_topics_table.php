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
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('start_date');
            $table->string('complate_date');
            $table->string('topic_start_date');
            $table->string('topic_end_date');
            $table->string('report_file')->nullable();
            $table->text('comment')->nullable();
            $table->string('lecturer_score')->nullable();
            $table->string('total_score')->nullable();
            $table->string('result')->nullable();
            $table->bigInteger('topic_catalogue_id')->unsigned();
            $table->bigInteger('major_id')->unsigned();
            $table->bigInteger('school_year_id')->unsigned();
            $table->bigInteger('lecturer_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('topics');
    }
};

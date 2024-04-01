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
        Schema::create('user_catalogues', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->tinyInteger('publish')->default(0);
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('user_catalogue_id');
            $table->foreign('user_catalogue_id')
                    ->references('id')
                    ->on('user_catalogues')
                    ->onUpdate('cascade')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_catalogues');
    }
};

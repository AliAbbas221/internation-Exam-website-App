<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('content');
            $table->string('reference');
            $table->foreignId('term_id')->nullable()->references('id')->on('terms')->onDeleteCascade();
            $table->foreignId('collage_id')->references('id')->on('collages')->cascadeOnDelete();
            $table->foreignId('specialization_id')->references('id')->on('specializations')->cascadeOnDelete();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
};

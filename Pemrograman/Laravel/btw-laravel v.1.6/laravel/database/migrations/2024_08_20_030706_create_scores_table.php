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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->integer('lesson_id');
            $table->integer('student_id');
            $table->integer('is_present');
            $table->integer('s_run');
            $table->integer('s_pushup');
            $table->integer('s_pullup');
            $table->integer('s_situp');
            $table->integer('s_shuttle');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};

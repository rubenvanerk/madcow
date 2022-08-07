<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('workout_id')->constrained()->cascadeOnDelete();
            $table->string('exercise');
            $table->integer('weight')->unsigned();
            $table->tinyInteger('target_reps')->unsigned();
            $table->tinyInteger('completed_reps')->unsigned()->nullable();
            $table->timestamps();
        });
    }
};

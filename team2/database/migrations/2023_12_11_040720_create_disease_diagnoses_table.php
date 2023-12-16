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
        Schema::create('disease_diagnoses', function (Blueprint $table) {
            $table->integer('disease_diagnosis_id');
            $table->integer('disease_id');
            $table->integer('diagnosis_id');

            $table->primary('disease_diagnosis_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disease_diagnoses');
    }
};

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
        Schema::create('pandemics', function (Blueprint $table) {
            $table->integer('pandemic_id');
            $table->string('pandemic_name')->unique();
            $table->string('pandemic_symptoms');
            $table->timestamps();
            $table->softDeletes();

            $table->primary('pandemic_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pandemics');
    }
};

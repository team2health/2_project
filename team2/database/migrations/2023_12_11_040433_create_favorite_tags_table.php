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
        Schema::create('favorite_tags', function (Blueprint $table) {
            $table->increments('favorite_tag_id');
            $table->integer('hashtag_id');
            $table->integer('u_id');
            $table->timestamps(); // created_at만 사용
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_tags');
    }
};

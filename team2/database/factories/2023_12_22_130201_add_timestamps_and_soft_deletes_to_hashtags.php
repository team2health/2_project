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
        Schema::table('hashtags', function (Blueprint $table) {
            $table->timestamps();

            // 소프트 삭제를 위한 deleted_at 컬럼 추가
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
        Schema::table('hashtags', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();
        });
    }
};

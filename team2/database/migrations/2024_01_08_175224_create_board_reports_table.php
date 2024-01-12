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
        Schema::create('board_reports', function (Blueprint $table) {
            $table->increments('board_report_id');
            $table->integer('board_id');
            $table->integer('u_id');
            $table->char('board_reason_flg', 2);
            $table->char('board_report_complete', 1)->default(0);
            $table->timestamps();
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
        Schema::dropIfExists('board_reports');
    }
};

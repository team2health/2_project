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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_email')->unique();
            $table->string('user_name')->unique();
            $table->string('user_password');
            $table->date('birthday');
            $table->string('user_address_num');
            $table->string('user_address');
            $table->string('user_address_detail')->nullable();
            $table->char('user_gender', 1);
            $table->string('user_img')->default('../img/default_f.png');
            $table->string('agreement_flg', 1);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

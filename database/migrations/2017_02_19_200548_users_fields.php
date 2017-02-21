<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday')->nullable();
            $table->string('image')->default('default.jpg');
            $table->string('phone')->nullable();
            $table->text('about')->nullable();
            $table->text('citate')->nullable();
            $table->string('status')->nullable();
            $table->string('web-site')->nullable();
            $table->string('icq')->nullable();
            $table->string('skype')->nullable();
            $table->string('pay_card_pb')->nullable();
            $table->string('pay_card_2')->nullable();
            $table->string('webmoney_id')->nullable();
            $table->string('wmz')->nullable();
            $table->string('ee')->nullable();
            $table->string('okpay')->nullable();
            $table->text('resume')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}

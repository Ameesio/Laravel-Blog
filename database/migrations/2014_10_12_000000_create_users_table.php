<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
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
            $table->string('name',100)->unique();
            $table->string('email',100)->unique();
            $table->string('password');
            $table->enum('role',['admin','author','subscriber'])->default('subscriber');
            $table->string('bannerColor')->default('#707070');
            $table->string('following')->default('1|');
            $table->enum('requested',['no','yes'])->default('no');
            $table->string('about')->default('Hey there, welcome to my blog!');
            $table->integer('strikes')->default(0);
            $table->integer('rank')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

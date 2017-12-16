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
            $table->string('name');
            $table->string('password');
            $table->string('email')->unique();

            //additional fields of preference.
            $table->string('nickName')->default('none');
            $table->string('profileImage')->default('/images/default.png');
            $table->string('nativeLanguage')->default('Korean');
            $table->string('learningLanguage')->default('English');
            $table->string('city')->default('Seoul');
            $table->integer('numberOfActions')->default(0);
            $table->integer('numberOfBestAnswers')->default(0);
            $table->integer('numberOfFavorites')->default(0);
            
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

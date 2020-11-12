<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->string('user_id');
            $table->string('email', 191)->unique();
            $table->integer('savings')->default(0);
            $table->integer('education')->default(0);
            $table->integer('rent')->default(0);
            $table->integer('feeding')->default(0);
            $table->integer('entertainment')->default(0);
            $table->integer('gifts')->default(0);
            $table->integer('miscellaneous')->default(0);
            $table->integer('others')->default(0);
            $table->integer('transport')->default(0);
            $table->integer('total_worth')->default(0);
            $table->timestamp('email_verified_at')->nullable();
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

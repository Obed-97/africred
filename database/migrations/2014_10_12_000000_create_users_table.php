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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('role_id');
            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('pays_id');
            $table->foreign('pays_id')
                  ->references('id')
                  ->on('pays')
                  ->onDelete('cascade')->nullable();
            $table->string('nom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('telephone')->nullable();
            $table->string('sexe')->nullable();
            $table->date('date_n')->nullable();
            $table->string('lieu_n')->nullable();
            $table->string('ville')->nullable();
            $table->string('adresse')->nullable();
            $table->string('image')->default('avatar.png');
            $table->string('password');
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
};

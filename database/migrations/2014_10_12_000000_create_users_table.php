<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('login')->nullable();
            $table->string('country')->nullable();
            $table->string('label_admin')->nullable();
            $table->boolean('socument_suc')->default(false);
            $table->boolean('ban')->default(false);
            $table->boolean('no_money')->default(false);
            $table->boolean('no_vivod')->default(false);
            $table->boolean('no_transfer')->default(false);
            $table->decimal('money', 15, 2)->default(0);
            $table->string('cur')->default('RUB');
            $table->decimal('bonus', 15, 2)->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};

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
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('address')->nullable();
            $table->string('mobile')->nullable();
            $table->float('lat')->nullable();
            $table->float('long')->nullable();
            $table->string('device_token')->nullable();
            $table->string('social_id')->nullable();
            $table->enum('login_type',['email','google','facebook','twitter','github','whatsapp','viber'])->default('email');
            $table->string('image')->nullable();
            
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('avatar_url')->default("/uploaded/default_avatar.jpg");
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->timestamp('user_verified_at')->nullable();
            $table->string('password_reset_token')->nullable();
            $table->string('activation_token')->nullable();
            $table->string('password');
            $table->text('expo_token')->nullable();
            $table->dateTime("sub_date")->default(now()->addDays(30));
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

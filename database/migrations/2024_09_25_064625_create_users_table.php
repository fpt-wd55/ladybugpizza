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
            $table->string('username')->unique();
            $table->foreignId('role_id')->constrained()->onDelete('cascade');
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
            $table->string('fullname');
            $table->string('phone')->unique()->nullable();
            $table->string('password');
            $table->string('google_id')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->tinyInteger('gender')->nullable()->comment('1: male; 2: female; 3: other');
            $table->tinyInteger('status')->default(1)->comment('1: active; 2: inactive');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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

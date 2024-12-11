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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('image');
            $table->text('description')->nullable();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->integer('price');
            $table->integer('discount_price')->default(0);
            $table->integer('daily_quantity')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('sku')->unique();
            $table->tinyInteger('status')->default(1)->comment('1: Hoạt động; 2: khóa');
            $table->tinyInteger('is_featured')->default(2)->comment('1: yes; 0: no');
            $table->float('avg_rating')->default(5);
            $table->integer('total_rating')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

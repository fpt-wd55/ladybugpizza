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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('description');
            $table->string('discount_type');
            $table->bigInteger('discount_value');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('quantity');
            $table->bigInteger('min_order_total')->nullable();
            $table->bigInteger('max_discount')->nullable();
            $table->tinyInteger('is_global')->default(2)->comment('1: global, 2: not global');
            $table->tinyInteger('status')->default(1)->comment('1: active, 2: inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};

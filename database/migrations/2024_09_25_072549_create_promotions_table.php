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
            $table->integer('points')->default(0);
            $table->integer('discount_type')->default(1)->comment('1: percent, 2: amount');
            $table->integer('discount_value');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('quantity');
            $table->integer('min_order_total')->nullable();
            $table->integer('max_discount')->nullable();
            $table->integer('is_global')->default(2)->comment('1: Tất cả , 2: Không phải tất cả');
            $table->foreignId('rank_id')->nullable()->constrained('membership_ranks')->onDelete('cascade');
            $table->integer('status')->default(1)->comment('1: active, 2: inactive');
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

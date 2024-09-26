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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('promotion_id')->nullable()->constrained()->onDelete('set null');
            $table->bigInteger('total_amount');
            $table->foreignId('address_id')->constrained()->onDelete('cascade');
            $table->bigInteger('discount_amount')->default(0);
            $table->bigInteger('shipping_fee')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->text('note')->nullable();
            $table->foreignId('payment_method_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_status_id')->constrained()->onDelete('cascade');
            $table->text('cancel_reason')->nullable();
            $table->timestamp('cancel_at')->nullable(); 
            // $table->foreignId('cancel_code')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('card_number')->nullable();
            $table->string('card_holder_name')->nullable();
            $table->string('expiration_month', 2)->nullable();
            $table->string('expiration_year', 4)->nullable();
            $table->string('cvv')->nullable();
            $table->decimal('amount', 10, 2);
            $table->string('status')->default('pending'); // pending, completed, failed
            $table->string('payment_method')->default('card');
            $table->string('transaction_id')->nullable(); // For payment gateway reference
            $table->json('payment_details')->nullable(); // For storing additional payment information
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

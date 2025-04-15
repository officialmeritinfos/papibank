<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_payments', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to users table
            $table->string('account_number'); // Account number used for the bill payment
            $table->decimal('amount', 15, 2); // Amount to be paid
            $table->string('payee'); // Name of the payee
            $table->string('address1'); // First address field
            $table->string('address2')->nullable(); // Second address field (optional)
            $table->string('city'); // City
            $table->string('state'); // State
            $table->string('zipcode'); // Zipcode
            $table->enum('delivery_method', ['Paper Check', 'Digital Receipt']); // Delivery type
            $table->string('memo')->nullable(); // Memo (optional)
            $table->enum('status', ['pending', 'processing', 'completed', 'failed'])->default('pending'); // Transaction status
            $table->date('delivery_date'); // Expected delivery date of the bill payment
            $table->boolean('is_favorite')->default(false); // If user wants to save this payee
            $table->timestamps(); // Created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_payments');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('transaction_type', ['deposit', 'withdrawal']);
            $table->enum('deposit_type', ['crypto', 'gift_card', 'bank', ''])->nullable();
            $table->decimal('amount', 50, 2);
            $table->decimal('fee', 50, 2)->default(0.00);
            $table->decimal('final_amount', 50, 2);
            $table->enum('status', ['pending', 'completed', 'failed','processing'])->default('pending');
            $table->text('details')->nullable();

            $table->string('transaction_id')->unique(); // Unique reference for every transaction
            $table->string('recipient_bank_name')->nullable();
            $table->string('bank_sort_code')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('account_number')->nullable();
            $table->string('account_holder')->nullable();
            $table->text('description')->nullable();

            // Optional reference for crypto transactions
            $table->string('payment_method',150)->nullable();
            // Additional deposit fields
            $table->string('gift_card_code')->nullable();
            $table->string('transaction_hash')->nullable();
            $table->string('payment_receipt')->nullable();

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
        Schema::dropIfExists('account_transactions');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryptocurrency_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('wallet');
            $table->enum('type', ['crypto'])->default('crypto');
            $table->string('network');
            $table->timestamps();
        });

        Schema::create('gift_card_methods', function (Blueprint $table) {
            $table->id();
            $table->string('merchant');
            $table->enum('type', ['gift_card'])->default('gift_card');
            $table->timestamps();
        });

        Schema::create('bank_transfer_methods', function (Blueprint $table) {
            $table->id();
            $table->string('method');
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('detail');
            $table->enum('type', ['bank'])->default('bank');
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
        Schema::dropIfExists('cryptocurrency_methods');
        Schema::dropIfExists('gift_card_methods');
        Schema::dropIfExists('bank_transfer_methods');
    }
}

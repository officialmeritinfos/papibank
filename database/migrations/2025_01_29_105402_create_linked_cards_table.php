<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkedCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linked_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('card_type'); // Visa, MasterCard, etc.
            $table->string('card_owner');
            $table->string('card_number')->unique(); // Store only the last 4 digits for security
            $table->integer('expiry_month');
            $table->integer('expiry_year');
            $table->string('cvv'); // Consider encrypting this for security
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('linked_cards');
    }
}

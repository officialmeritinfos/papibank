<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 150);
            $table->string('last_name', 150);
            $table->string('username', 30)->unique();
            $table->string('email', 254)->unique();
            $table->string('phone', 30)->unique();
            $table->date('dob');
            $table->string('password');
            $table->enum('occupation', [
                'Self Employed', 'Public/Government Office', 'Private/Partnership Office',
                'Business/Sales', 'Trading/Market', 'Military/Paramilitary', 'Politician/Celebrity'
            ]);
            $table->string('country', 100);
            $table->string('state', 100);
            $table->string('city', 100);
            $table->string('postal_code', 30)->nullable();
            $table->string('street_address', 255);
            $table->enum('gender', ['M', 'F','Other']);
            $table->string('religion', 100)->nullable();
            $table->string('registrationIp');
            $table->enum('account_type', [
                'Savings Account', 'Current Account', 'Checking Account', 'Fixed Deposit Account',
                'Crypto Currency Account', 'Business Account', 'Non Resident Account', 'Cooperate Business Account', 'Investment Account'
            ]);
            $table->string('account_currency', 10);
            $table->string('balance')->default(0);
            $table->string('loan')->default(0);
            $table->string('credit_score')->default(0);
            $table->string('account_number')->nullable();
            $table->string('referral', 50)->nullable();
            $table->string('profile_picture', 255)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('phone_verified_at')->nullable();
            $table->integer('emailVerified')->default(1);
            $table->boolean('is_admin')->default(0);
            $table->boolean('twoWay')->default(0);
            $table->boolean('twoWayPassed')->default(0);
            $table->enum('status', ['active', 'inactive', 'suspended', 'banned'])->default('active');
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::dropIfExists('users');
    }
}

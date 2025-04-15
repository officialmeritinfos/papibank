<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded=[];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the bill payments associated with the user.
     */
    public function billPayments(): HasMany
    {
        return $this->hasMany(BillPayment::class);
    }
    public function loanRequests()
    {
        return $this->hasMany(LoanRequest::class);
    }

    /**
     * Get the country associated with the user.
     */
    public function countrys()
    {
        return $this->belongsTo(Country::class, 'country', 'iso2');
    }

    public function transactions()
    {
        return $this->hasMany(AccountTransaction::class, 'user_id');
    }

    public function loans()
    {
        return $this->hasMany(LoanRequest::class, 'user_id');
    }

    public function virtualCards()
    {
        return $this->hasMany(VirtualCardRequest::class, 'user_id');
    }


    // In App\Models\User.php

    public function getNameAttribute()
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

}

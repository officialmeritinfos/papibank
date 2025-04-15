<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;


    /**
     * Get all users that belong to this country.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'country', 'iso2');
    }
}

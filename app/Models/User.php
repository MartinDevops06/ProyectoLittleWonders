<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'name',
        'last_name', 
        'email',
        'password',
        'phone',
        'birth_date',
        'is_admin'
    ];
    
    protected $hidden = ['password'];
    
    protected $casts = [
        'is_admin' => 'boolean',
        'birth_date' => 'date'
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function primaryAddress()
    {
        return $this->hasOne(Address::class)->where('is_primary', true);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

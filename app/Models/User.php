<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

   
    protected $fillable = [
        'name', 'email', 'password',
    ];

    
    protected $hidden = [
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function debtors()
    {
        return $this->hasMany(Debtor::class);
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }


    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }


    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/y H:i:s');
    }
}

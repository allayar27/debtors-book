<?php

namespace App\Models;

use Carbon\Carbon;
use Hash;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];


    protected $hidden = [
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'avatar_url'
    ];


    public function debtors()
    {
        return $this->hasMany(Debtor::class);
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }




    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }


    public function getAvatarUrlAttribute()
    {
        if($this->avatar && Storage::disk('avatars')->exists($this->avatar)) {
            return asset('/storage/avatars/'.$this->avatar);
        }
        return asset('not_found.png');
    }



}

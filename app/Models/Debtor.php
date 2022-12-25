<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debtor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'balance', 'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(){

        return $this->hasMany(Transaction::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/y H:i:s');
    }
}

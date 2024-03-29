<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Debtor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'phone', 'reserve_phone', 'balance',
    ];



    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

 
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }


    public function scopeWhereHasDebts(Builder $query)
    {
       $debtor = $query->whereHas('transactions', function($transaction) {
            $transaction->where('transaction_type', 'credit');
        })->get();

        return $debtor->count();
    }


}

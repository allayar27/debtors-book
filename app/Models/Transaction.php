<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'debtor_id', 
        'pay_amount', 
        'received_amount', 
        'transaction_remark', 
        'transaction_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function debtor()
    {
        return $this->belongsTo(Debtor::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/y H:i:s');
    }


    public function scopeSearch($query, $term)
    {
        $query->WhereHas('debtor', function($query) use ($term)
        {
            $query->where('name', 'like', '%'. $term.'%');
        });

    }

    
}

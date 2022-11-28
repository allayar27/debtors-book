<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebtPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'amount',
        
    ];

    public function client(){

        return $this->belongsTo(Client::class);

    }
}

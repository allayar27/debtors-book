<?php



namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


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
        return Carbon::parse($value)->format('d/m/Y H:i');
    }


    public function scopeSearch($query, $term):void
    {
        $query->WhereHas('debtor', function($query) use ($term) {
            $query->where('name', 'like', '%'. $term.'%');
        });

    }

    public function scopeTotalDebts():float
    {
        //return $this->where('transaction_type', 'credit')->sum('pay_amount');
       return DB::table('transactions')->where('transaction_type', 'credit')->get()->sum('pay_amount');
    }

    public function scopeTotalDebtsPaid():float
    {
        return DB::table('transactions')->where('transaction_type', 'debit')->get()->sum('received_amount');
    }

    // public function scopeShowDebtsPercent(): int
    // {
    //    $credit = $this->totalDebts();
    //    $debit = $this->totalDebtsPaid();
    //    if($credit > 0){
    //        return round(($credit - $debit) * 100 / $credit);
    //    }
    //     return 0;
    // }

    // public function scopeShowPaidDebtsPercent():int
    // {
    //    $credit = $this->totalDebts();
    //    $debit = $this->totalDebtsPaid();
    //    if($credit > 0) {
    //        return ($debit * 100) / $credit;
    //    }
    //    return 0;
    // }

}

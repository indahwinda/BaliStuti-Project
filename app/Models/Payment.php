<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = [
        'order_id',
        'payment_id',
        'payer_id',
        'payer_email',
        'payment_method',
        'amount',
        'currency',
        'payment_status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }


}

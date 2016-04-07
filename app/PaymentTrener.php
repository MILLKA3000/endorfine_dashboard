<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentTrener extends Model
{
    protected $table = 'paymentTrainer';
    protected $fillable = [
        'user_id', 'payment_id'
    ];
}

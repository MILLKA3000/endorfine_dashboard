<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentsVariables extends Model
{
    protected $table = 'paymentsVariables';
    protected $fillable = [
        'name', 'user_id', 'typePayments_id', 'min', 'value'
    ];
    public function getTypeVariables()
    {
        return $this->hasOne('app/TypeVariablesOfPayment','id','type_id');
    }
}

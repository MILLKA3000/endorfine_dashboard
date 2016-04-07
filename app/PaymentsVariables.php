<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentsVariables extends Model
{
    protected $table = 'paymentsVariables';
    protected $fillable = [
        'name', 'type_id', 'min', 'value'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeVariablesOfPayment extends Model
{
    protected $table = 'typeVariables';
    protected $fillable = [
        'name'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'additionalServices_Type';
    protected $guarded  = array('id');
    protected $fillable = [
        'name', 'detail', 'activityTime', 'value', 'enabled'
    ];
}

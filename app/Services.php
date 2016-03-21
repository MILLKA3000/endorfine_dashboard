<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'additionalServicesType';
    protected $fillable = [
        'name', 'detail', 'activityTime', 'value', 'enabled'
    ];
}

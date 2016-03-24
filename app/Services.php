<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'additionalServicesType';
    protected $guarded  = array('id');
    protected $fillable = [
        'name', 'detail', 'activityTime', 'value', 'enabled'
    ];
}

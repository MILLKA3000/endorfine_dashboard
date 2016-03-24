<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientStatuses extends Model
{
    protected $table = 'client_statuses';

    protected $guarded  = array('id');

    protected $fillable = [
        'name', 'discount_id'
    ];

    public function getNameDiscountForClients()
    {
        return $this->hasOne('App\Discounts','id','discount_id');
    }
}

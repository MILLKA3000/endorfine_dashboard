<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientToService extends Model
{
    protected $table = 'additionalServices_ToClients';

    protected $guarded  = array('id');

    protected $fillable = [
        'client_id', 'service_id','endDateForUse'

    ];

    public function getService()
    {
        return $this->hasOne('App\AdditionalServises','id','service_id');
    }

    public function getClient()
    {
        return $this->hasOne('App\clients','id','client_id');
    }

}

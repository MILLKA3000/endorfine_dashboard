<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $guarded  = array('id');

    protected $fillable = [
        'name', 'phone', 'photo', 'birthday', 'detail', 'note', 'status_id', 'enabled'
    ];

    public function getNameStatus()
    {
        return $this->hasOne('App\ClientStatuses','id','status_id');
    }

    public function getActiveTickets()
    {
        return $this->hasMany('App\ClientsToTickets','client_id','id')->where('statusTicket_id',1);
    }

}

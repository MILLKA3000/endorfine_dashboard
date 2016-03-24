<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $table = 'client_info';

    protected $guarded  = array('id');

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'phone', 'photo', 'birthday', 'detail', 'note', 'status_id', 'enabled'
    ];

    public function getNameStatus()
    {
        return $this->hasOne('App\ClientStatuses','id','status_id');
    }

    public function getNumTicket()
    {
        return $this->hasOne('App\ClientsToTickets','client_id','id');
    }

    public function getActiveTickets()
    {
        return $this->hasMany('App\ClientsToTickets','client_id','id')->whereIn('statusTicket_id',[1,2]);
    }

    public function getActiveTraning()
    {
        return $this->hasMany('App\ClientsToTickets','client_id','id')->whereIn('statusTicket_id',[1,2]);
    }

}

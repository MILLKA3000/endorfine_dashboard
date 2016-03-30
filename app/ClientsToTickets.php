<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientsToTickets extends Model
{
    use SoftDeletes;

    protected $table = 'clientsToTickets';

    protected $guarded  = array('id');

    protected $dates = ['deleted_at'];

    protected $softDelete = true;

    protected $fillable = [
        'ticket_id', 'client_id', 'statusTicket_id', 'discount_id', 'numTicket'

    ];

    public function getNameTicket()
    {
        return $this->hasOne('App\Ticket','id','ticket_id');
    }

    public function getNameClient()
    {
        return $this->hasOne('App\Client','id','client_id');
    }

    public function hasEnabled()
    {
        return $this->hasOne('App\Ticket','id','ticket_id')->where('enabled','1');
    }

    public function getQtyTicket()
    {
        return $this->hasMany('App\Ticket','id','ticket_id');
    }

    public function getStatusTicket()
    {
        return $this->hasOne('App\StatusesTicket','id','statusTicket_id');
    }

    public function getNameDiscountForTicket()
    {
        return $this->hasOne('App\Discounts','id','discount_id');
    }

    public function getTrainings()
    {
        return $this->hasMany('App\VisitedClients','ticket_id','id');
    }
}

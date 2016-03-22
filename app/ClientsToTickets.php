<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsToTickets extends Model
{
    protected $table = 'clientsToTickets';

    protected $guarded  = array('id');

    protected $fillable = [
        'ticket_id', 'client_id', 'statusTicket_id', 'discount_id', 'numTicket'

    ];

    public function getNameTicket()
    {
        return $this->hasOne('App\Ticket','id','ticket_id');
    }

    public function getNameDiscountForTicket()
    {
        return $this->hasOne('App\Discounts','id','discount_id');
    }
}

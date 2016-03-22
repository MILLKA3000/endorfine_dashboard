<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientsToTickets extends Model
{
    protected $table = 'clientsToTickets';

    protected $guarded  = array('id');

    protected $fillable = [
        'ticket_id', 'client_id', 'statusTicket_id', 'discount_id'

    ];

}

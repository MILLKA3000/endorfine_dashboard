<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitedClients extends Model
{
    protected $table = 'client_Visited';

    protected $guarded  = array('id');

    protected $fillable = [
        'ticket_id', 'training_id'
    ];
}

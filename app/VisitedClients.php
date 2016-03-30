<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VisitedClients extends Model
{
    protected $table = 'client_Visited';

    protected $guarded  = array('id');

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'ticket_id', 'training_id'
    ];
}

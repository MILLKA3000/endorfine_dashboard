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

    public function getDetailTraining()
    {
        return $this->hasOne('App\TraningToTrainer','id','training_id');
    }

    public function getTicket()
    {
        return $this->hasOne('App\ClientsToTickets','id','ticket_id');
    }
}

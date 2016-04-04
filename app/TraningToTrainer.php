<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TraningToTrainer extends Model
{
    protected $table = 'training_toTrainer';

    protected $guarded  = array('id');
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_events', 'id_user', 'name', 'start', 'end','description'
    ];


    public function getNameTrainer(){
        return $this->hasOne('App\User','id','id_user');
    }

    public function getVisitedClients(){
        return $this->hasMany('App\VisitedClients','training_id','id');
    }
}

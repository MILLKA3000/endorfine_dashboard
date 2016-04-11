<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinTrainerToRoom extends Model
{
    protected $table = 'chapter_trainer_to_rooms';

    protected $guarded  = array('id');

    public function getTrainers(){
        return $this->hasManyThrough('App\Role','id','role_id');
    }

    public function getAllowedTrainers(){
        return $this->hasMany('App\User','id','trainer_id');
    }
}

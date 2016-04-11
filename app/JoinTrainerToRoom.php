<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinTrainerToRoom extends Model
{
    protected $table = 'chapter_trainer_to_rooms';

    protected $guarded  = array('id');

    public function getNameRoom()
    {
        return $this->hasOne('App\Room','id','room_id');
    }
}

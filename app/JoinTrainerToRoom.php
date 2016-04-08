<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinTrainerToRoom extends Model
{
    protected $table = 'chapter_trainer_to_rooms';

    protected $guarded  = array('id');
}

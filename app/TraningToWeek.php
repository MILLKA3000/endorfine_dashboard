<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TraningToWeek extends Model
{
    protected $table = 'training_OfWeeks';

    protected $guarded  = array('id');
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_training_detail', 'numDay', 'start_time','end_time'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TraningDetails extends Model
{
    protected $table = 'training_detail';

    protected $guarded  = array('id');
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'detail'
    ];
}

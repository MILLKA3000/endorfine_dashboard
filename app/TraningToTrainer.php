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
        'id_training', 'id_user', 'detail'
    ];

    public function getAllTranings(){
        return $this->hasMany('App\TraningToWeek','id','id_training');
    }
    public function getNameTrainer(){
        return $this->hasOne('App\User','id','id_user');
    }
}

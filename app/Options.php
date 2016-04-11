<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $table = 'options';
   
    public function getOptionsValue()
    {
        return $this->hasOne('App\OptionsForChapters','id_options','id');
    }
}

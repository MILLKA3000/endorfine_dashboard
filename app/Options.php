<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Options extends Model
{
    protected $table = 'options';
   
    public function getOptionsValue()
    {
        return $this->hasMany('App\OptionsForChapters','id_options','id')->
        where('id_chapter',Cache::get('chapterActive'));
    }
    
    static public function getIdForOptions($key)
    {
        return self::where('key', $key)->select('id')->get()->first()->id;
    }
}

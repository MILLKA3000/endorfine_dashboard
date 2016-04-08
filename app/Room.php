<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Room extends Model
{
    use SoftDeletes;

    protected $table = 'chapter_rooms';

    protected $guarded  = array('id');

    protected $softDelete = true;

    protected $fillable = [
        'name', 'chapter_id', 'info'
    ];

    public function getNameChapter()
    {
        return $this->hasOne('App\Chapter','id','chapter_id');
    }

    public function getTrainerFromRoom()
    {
        return $this->hasMany('App\JoinTrainerToRoom','room_id','id');
    }

    static public function getRoomsFromActiveChapters()
    {
        return self::where('chapter_id',Cache::get('chapterActive'))->get();
    }

}

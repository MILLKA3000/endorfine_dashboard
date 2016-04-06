<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'name'
    ];

    static public function getTrainer()
    {
        return self::whereId(3)->get();
    }

    static public function getAdminAndManager()
    {
        return self::where('id','<','3')->get();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use SoftDeletes;

    protected $table = 'chapter_list';

    protected $guarded  = array('id');

    protected $softDelete = true;

    protected $fillable = [
        'name', 'address', 'info','email'
    ];
}

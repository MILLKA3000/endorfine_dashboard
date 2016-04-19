<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionsForChapters extends Model
{
    protected $table = 'options_for_chapters';
    protected $fillable = [
        'id_options', 'id_chapter', 'value', 'array_permissions'
    ];
}

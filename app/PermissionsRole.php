<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionsRole extends Model
{
    protected $table = 'permissions_role';
    protected $fillable = [
        'id_role', 'permissions_tag'
    ];
}

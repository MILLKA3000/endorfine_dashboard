<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;

class CacheController extends Cache
{
    static private $time = 50000000;

    static public function putKey($key,$value){
        self::forget($key);
        self::put($key, $value, self::$time);
        return true;
    }
}

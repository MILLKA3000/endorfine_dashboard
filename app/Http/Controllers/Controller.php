<?php

namespace App\Http\Controllers;

use App\Client;
use App\Options;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        Cache::flush();
        $options = Options::all();
        foreach ($options as $option)
        {
            Cache::put($option->key, $option->value, 100);
        }
        Cache::put('countBirthday', count(Client::getAllBirthdayNow()),1000);
    }
}
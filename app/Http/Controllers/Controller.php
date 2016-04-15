<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Client;
use App\Models\CacheController;
use App\Options;
use App\Room;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $chapter;

    public function __construct()
    {
        $options = Options::all();
        foreach ($options as $option)
        {
            Cache::forget($option->key);

            Cache::put($option->key, !empty($option->getOptionsValue->first()->value) ? 
                $option->getOptionsValue->first()->value : $option->defaultValue, 100);
        }
        Cache::put('countBirthday', count(Client::getAllBirthdayNow()),1000);

        Cache::put('chapters',Chapter::all(), 1000);

        Cache::put('rooms',Room::whereChapterId(Cache::get('chapterActive'))->get()->lists('name','id'), 1000);
    }

    private function changeChapter(){
        CacheController::putKey('chapterActive', $this->chapter);
    }

    public function setChapter($chapter){
        $this->chapter = $chapter;
        $this->changeChapter();
        return redirect()->back();
    }


}
<?php

namespace App\Http\Controllers;

use App\Models\Calendar\GetAllCalendarsModel;
use App\Models\Search;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;

class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function search(Request $request)
    {
        $search = new Search($request->search);
        $html = $search->searchResult();
        return $html;
//        return view('home');
    }

    public function graph()
    {
        $modelEvents = new GetAllCalendarsModel();
        $trainings = $modelEvents->getAllTrainingThisDay();
        return view('search.ajax-graph',compact('trainings'));
    }
}

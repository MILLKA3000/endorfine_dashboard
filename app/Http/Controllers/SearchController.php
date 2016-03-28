<?php

namespace App\Http\Controllers;

use App\Models\Search;
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
}

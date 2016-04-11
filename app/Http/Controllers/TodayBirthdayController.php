<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

use App\Http\Requests;

class TodayBirthdayController extends Controller
{
    public function index()
    {
        $clients = Client::select('id', 'photo', 'name', 'phone')->where('birthday', date("Y-m-d"))->get();
        return view('nav_bar_info.birthdays.index', compact('clients'));
    }
}

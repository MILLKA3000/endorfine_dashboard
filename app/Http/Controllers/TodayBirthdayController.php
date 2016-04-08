<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TodayBirthdayController extends Controller
{
    public function index()
    {
        return view('nav_bar_info.birthdays.index');
    }
}

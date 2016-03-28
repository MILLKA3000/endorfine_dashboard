<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $birthdays = Client::select('id', 'name', 'birthday')->get()->take(3);
//        $thisDay = Carbon::parse("this day")->format('Y-m-d');
//        select * from `client_info` where DATE_FORMAT(birthday,'%m-%d') >= DATE_FORMAT(NOW(),'%m-%d') and `client_info`.`deleted_at` is null
//        $birthday = Client::where('DATE_FORMAT(FROM_UNIXTIME(birthday),\'%m-%d\')', '>', '\'DATE_FORMAT(NOW(),\'%m-%d\')\'')->get();

        $datas = $birthdays;
        $date = Carbon::parse("+1 day")->format('Y-m-d');
        foreach ($datas as $value){
            $value->enddate=$date;
        }

        return view('home', compact('birthdays', 'datas'));
    }
}

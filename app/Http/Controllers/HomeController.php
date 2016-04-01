<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests;
use App\Models\Calendar\GetAllCalendarsModel;
use App\Models\Dashboard\GeneralModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $model_dashboard;

    public function __construct()
    {
        $this->model_dashboard = new GeneralModel(['addDays'=>7]);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $birthdays = $this->model_dashboard->getBirthDayClient();
        $endOfDateTickets = $this->model_dashboard->getEndOfDateTickets();
        $modelEvents = new GetAllCalendarsModel();
        $trainings = $modelEvents->getAllTrainingThisDay();
        return view('home', compact('birthdays', 'endOfDateTickets','trainings'));
    }
}

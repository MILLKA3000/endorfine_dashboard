<?php

namespace App\Http\Controllers\Calendar;

use App\TraningToTrainer;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Services\GoogleCalendar;

class ForAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events_to_calendar = [];

        $calendar = new GoogleCalendar;

        $options = [
            'timeMin' => Carbon::parse("-2 month")->toRfc3339String(),
            'timeMax' => Carbon::parse("last day of next month")->toRfc3339String(),
            'maxResults' => 10000,
            'orderBy' => 'startTime',
            'singleEvents' => TRUE,
        ];
        $calendarId = "natalya.4ekanova@gmail.com";

        $events = $calendar->getEvents($calendarId,$options);

        foreach ($events as $days)
        {

            if($days->end->dateTime != null )
                $events_to_calendar[] = [
                    'title' => (string)$days->summary,
                    'start' => (string)$days->start->dateTime,
                    'end' => (string)$days->end->dateTime,
                    'id' => (string)$days->id,
                    'textColor' => 'black',
                    'description' => $days->description,
                ];
        }

//dd($events_to_calendar);
//        $trainers = TraningToTrainer::all();
//        foreach($trainers as $trainer){
//            foreach($trainer->getAllTranings as $traning){
//                for ($i=0; $i<=7; $i++){
//                    foreach ($this->getDays($i) as $days)
//                    {
////                        $calendarLocal = DetailsCalendar::where('training_id',$trainer->id)->get();
//
//                        if($traning->numDay == $days->dayOfWeek) {
//                            $events[] = [
//                                'title' => $traning->getTrainingDetail->name,
//                                'start' => $days->toDateString()." ".$traning->start_time,
//                                'end' => $days->toDateString()." ".$traning->end_time,
//                                'backgroundColor' => $traning->getTrainingDetail->color,
//                                'textColor' => 'black',
//                                'id' => $traning->id,
//                                'description' => $trainer->detail,
//                                'detail_description' => $trainer->detail,
//                                'trainer' => $trainer->getNameTrainer->name,
//                            ];
//                        }
//                    }
//                }
//
//            }
//        }
//
        $events_to_calendar = json_encode($events_to_calendar);
        return view('calendar.admin.index', compact('events_to_calendar'));
    }


    public function getDays($day)
    {
        return new \DatePeriod(
            Carbon::parse("first day of this month")->addDay($day),
            CarbonInterval::week(),
            Carbon::parse("first day of next month")->addMonth(1)
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

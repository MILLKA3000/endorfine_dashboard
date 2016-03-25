<?php

namespace App\Http\Controllers\Calendar;

use App\TraningToTrainer;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Laravel5GoogleCalendar\Calendar;
use App\Laravel5GoogleCalendar\Events as CalendarEvent;

use Illuminate\Support\Facades\Auth;

class ForAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        Calendar::setVar('calendar', '');
//
//        $aa = Calendar::readCalendar();
//        dd($aa);
//        https://www.googleapis.com/calendar/v3/calendars/natalya.4ekanova%40gmail.com/events?
        //callback=jQuery21402727069087633329_1458917943443&
        //key=AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE&
        //timeMin=2016-02-28T00%3A00%3A00%2B00%3A00&
        //timeMax=2016-02-28T00%3A00%3A00%2B00%3A00&
        //singleEvents=true&
        //maxResults=9999&
        //_=1458917943444
        $trainers = TraningToTrainer::all();
        foreach($trainers as $trainer){
            foreach($trainer->getAllTranings as $traning){
                for ($i=0; $i<=7; $i++){
                    foreach ($this->getDays($i) as $days)
                    {
//                        $calendarLocal = DetailsCalendar::where('training_id',$trainer->id)->get();

                        if($traning->numDay == $days->dayOfWeek) {
                            $events[] = [
                                'title' => $traning->getTrainingDetail->name,
                                'start' => $days->toDateString()." ".$traning->start_time,
                                'end' => $days->toDateString()." ".$traning->end_time,
                                'backgroundColor' => $traning->getTrainingDetail->color,
                                'textColor' => 'black',
                                'id' => $traning->id,
                                'description' => $trainer->detail,
                                'detail_description' => $trainer->detail,
                                'trainer' => $trainer->getNameTrainer->name,
                            ];
                        }
                    }
                }

            }
        }

        $events = json_encode($events);
        return view('calendar.admin.index', compact('events'));
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

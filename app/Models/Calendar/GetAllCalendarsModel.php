<?php

namespace App\Models\Calendar;

use App\TraningToTrainer;
use App\User;
use App\VisitedClients;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GetAllCalendarsModel extends Model
{
    protected $trainer;

    private $calendarsOfTrainer;

    public function __construct(){
        $this->trainer = $this->getAllTrainer();
    }

    private function getAllTrainer(){
        return User::where('role_id',3)->get();
    }


    private function getEventsFromCalendar($options){
        foreach($this->trainer as $trainer){
            $connectToCalendar = new GetAllEventsaModel($trainer->email,$options);
            $this->calendarsOfTrainer[] = $connectToCalendar->getAll();
        }
    }

    public function getAllEventsOfTrainers($options = []){
        $this->getEventsFromCalendar($options);
        return $this->calendarsOfTrainer;
    }

    public function reformatedEvents($titleWithTime = null){
        $events_to_calendar = [];
        foreach ($this->calendarsOfTrainer as $calendar)
            foreach ($calendar as $events)
            {
                if($events->end->dateTime != null )
                    $events_to_calendar[] = [
                        'title' => ($titleWithTime)? Carbon::parse($events->start->dateTime)->format('H:i').' '.(string)$events->summary:(string)$events->summary,
                        'start' => (string)$events->start->dateTime,
                        'end' => (string)$events->end->dateTime,
                        'id' => (string)$events->id,
                        'textColor' => 'black',
                        'description' => $events->description,
                        'trainer' => $events->organizer->displayName,
                        'email' => $events->organizer->email,
                    ];
            }
        $this->saveToDB($events_to_calendar);

        return $events_to_calendar;
    }

    public function getAllTrainingThisDay(){

        $fromDBEvents = $this->getCalendarEventsFromDB();

        if(!empty($fromDBEvents->first)){
            $training = $this->loadFromDB($fromDBEvents);
        }else{
            $this->getAllEventsOfTrainers([
                'timeMin'=> Carbon::parse("this day")->toDateString()."T00:00:00+00:00",
                'timeMax'=> Carbon::parse("this day")->toDateString()."T23:59:59+00:00",
            ]);
            $this->reformatedEvents();
            $training = $this->loadFromDB($this->getCalendarEventsFromDB());
        }


        return $training;
    }

    private function getCalendarEventsFromDB(){
        return TraningToTrainer::where('start','>',Carbon::parse("this day")->toDateString()." 00:00:00")
            ->where('start','<',Carbon::parse("this day")->toDateString()." 23:59:59")
            ->orderBy('start','ASC')
            ->get();
    }

    private function saveToDB($events_to_calendar){
        foreach ($events_to_calendar as $event)
        {
            $user_ID = User::where('email',$event['email'])->get()->first();
            if (isset($user_ID)) {
                $fromDB = TraningToTrainer::where('id_events', $event['id'])->get()->first();
                $event = [
                    'id_events' => $event['id'],
                    'id_user' => $user_ID->id,
                    'name' => $event['title'],
                    'description' => $event['description'],
                    'start' => $event['start'],
                    'end' => $event['end']
                ];
                if (!empty($fromDB)) {
                    $fromDB->update($event);
                } else {
                    TraningToTrainer::create($event);
                }
            }
        }
    }

    public function loadFromDB($events_to_calendar){
        $events = [];
        foreach ($events_to_calendar as $event){
                $events[] = [
                    'id' => $event['id_events'],
                    'trainer' => User::where('id',$event['id_user'])->get()->first()->name,
                    'trainer_id' => $event['id_user'],
                    'title' => $event['name'],
                    'description' => $event['description'],
                    'start' => $event['start'],
                    'end' => $event['end'],
                    'clients' => VisitedClients::where('training_id',$event['id'])->get()
                ];
        }
        return $events;
    }

    public function getActiveTraning(){

        $fromDBEvents = $this->getCalendarEventsFromDB();

        if(count($fromDBEvents)>0){
            $traningFormated = $this->loadFromDB($fromDBEvents);
        }else{
            $this->getAllEventsOfTrainers([
                'timeMin'=> Carbon::parse("this day")->toDateString()."T00:00:00+00:00",
                'timeMax'=> Carbon::parse("this day")->toDateString()."T23:59:59+00:00",
            ]);
            $this->reformatedEvents();
            $traningFormated = $this->loadFromDB($this->getCalendarEventsFromDB());
        }

        $activeTraning = array_first($traningFormated, function($key, $value)
        {
            if(Carbon::parse($value['start']) >= Carbon::parse("this day")->subMinute(50)) {
                return $value['id'];
            }
        });
        return compact('traningFormated','activeTraning');
    }

}

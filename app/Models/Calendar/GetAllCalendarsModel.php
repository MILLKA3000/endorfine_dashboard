<?php

namespace App\Models\Calendar;

use App\TraningToTrainer;
use App\User;
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
}

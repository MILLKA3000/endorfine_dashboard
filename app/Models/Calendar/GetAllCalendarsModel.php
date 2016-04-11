<?php

namespace App\Models\Calendar;

use App\JoinTrainerToRoom;
use App\Room;
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

    /**
     * Витягнути всіх тренерів
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    private function getAllTrainer(){
        return JoinTrainerToRoom::all();
    }

    /**
     * Витягає з гугл календарів всі івенти
     *
     * @param $options
     */
    private function getEventsFromCalendar($options){
        foreach($this->trainer as $trainer){
            $connectToCalendar = new GetAllEventsaModel($trainer->room_calendar_id,$options);
            $this->calendarsOfTrainer[] = $connectToCalendar->getAll();
        }
    }

    /**
     * витягує всі івенти по тренеру
     *
     * @param array $options
     * @return mixed
     */
    public function getAllEventsOfTrainers($options = []){
        $this->getEventsFromCalendar($options);
        return $this->calendarsOfTrainer;
    }


    /**
     * переформатування івентів від АПІ гуглу для виведення в fullCalendar.js
     * а також зберігає в БД
     *
     * @param null $titleWithTime
     * @return array
     */
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


    /**
     * Витягає доступні івенти на сьогоднішній день
     * якщо немає доступних в БД архіві то тяне по АПІ з Гуглу
     *
     * @return array
     */
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

    /**
     * Витягує івенти з архіву БД за сьогоднішній день
     *
     * @return mixed
     */
    private function getCalendarEventsFromDB(){
        $rooms = Room::getRoomsFromActiveChapters();
        foreach($rooms as $room){
            $room->training = TraningToTrainer::where('start','>',Carbon::parse("this day")->toDateString()." 00:00:00")
                ->where('start','<',Carbon::parse("this day")->toDateString()." 23:59:59")
                ->whereIdTrainerToRooms($room->id)
                ->orderBy('start','ASC')
                ->get();
        }
        return $rooms;
    }


    /**
     * Зберігає івенти в локальну БД
     *
     * @param $events_to_calendar
     */
    private function saveToDB($events_to_calendar){
        foreach ($events_to_calendar as $event)
        {
            $user_ID = JoinTrainerToRoom::where('room_calendar_id',$event['email'])->get()->first();
            if (isset($user_ID)) {
                $fromDB = TraningToTrainer::where('id_events', $event['id'])->get()->first();
                $event = [
                    'id_events' => $event['id'],
                    'id_user' => $user_ID->trainer_id,
                    'name' => $event['title'],
                    'description' => $event['description'],
                    'start' => $event['start'],
                    'id_trainer_to_rooms' => $user_ID->room_id,
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


    /**
     * Витягає івенти по вказаному залу тренування
     *
     * @param $rooms
     * @return array
     */
    public function loadFromDB($rooms){
        $events = [];
        foreach ($rooms as $events_to_calendar) {
            foreach ($events_to_calendar->training as $event) {
                if(!empty($event)) {
                    $events[$events_to_calendar->id][] = [
                        'id' => $event['id_events'],
                        'trainer' => User::where('id', $event['id_user'])->get()->first()->name,
                        'trainer_id' => $event['id_user'],
                        'title' => $event['name'],
                        'description' => $event['description'],
                        'start' => $event['start'],
                        'end' => $event['end'],
                        'clients' => VisitedClients::where('training_id', $event['id'])->get()
                    ];
                }
            }
        }
        return $events;
    }


    /**
     * Інтуїтивний пошук для вибору з селекту всіх тренувань підходяжче значення по часу
     * для уваги від часу зараз - $minutes(для запізнених клієнтів)
     *
     * @return array
     */
    public function getActiveTraning($minutesBack = 50){

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
        $traningFormated = array_collapse($traningFormated);

        $activeTraning = array_first($traningFormated, function($key, $value)
        {
            if(Carbon::parse($value['start']) >= Carbon::parse("this day")->subMinute($minutesBack)) {
                return $value['id'];
            }
        });

        return compact('traningFormated','activeTraning');
    }

}

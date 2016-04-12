<?php

namespace App\Http\Controllers;

use App\JoinTrainerToRoom;
use App\Models\Calendar\GetAllCalendarsModel;
use App\Models\Calendar\GetAllEventsaModel;
use App\TraningToTrainer;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class TrainingController extends Controller
{
    public function detailEvent($event_id){
        $event = TraningToTrainer::where('id_events',$event_id)->get()->first();
        return view('training.about-of-event',compact('event'));
    }

    public function detailTrainer(User $trainer){
        $helperCalendar = new GetAllCalendarsModel();
        $trainer->training = TraningToTrainer::whereIdUser($trainer->id)->get();
        $trainer->events = json_encode($helperCalendar->getEventFromColections($trainer));
        return view('training.about-of-trainer',compact('trainer'));
    }
}

<?php

namespace App\Models\Calendar;

use App\Services\GoogleCalendar;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GetAllEventsaModel extends Model
{
    public $timeMin;
    public $timeMax;
    protected $maxResults = 10000;
    protected $orderBy = 'startTime';
    protected $singleEvents = TRUE;
    protected $idCalendar;
    protected $options = [];

    public function __construct($idCalendar,$options){
        $this->idCalendar = $idCalendar;

        $this->options = [
            'timeMin' => Carbon::parse("first day of last month")->toRfc3339String(),
            'timeMax' => Carbon::parse("last day of next month")->toRfc3339String(),
            'maxResults' => $this->maxResults,
            'orderBy' => $this->orderBy,
            'singleEvents' => $this->singleEvents,
        ];

        $this->options = array_merge($this->options,$options);
    }

    public function getAll(){

        $calendar = new GoogleCalendar;

        return $events = $calendar->getEvents($this->idCalendar,$this->options);
    }
}

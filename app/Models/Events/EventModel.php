<?php

namespace App\Models\Events;

use App\Client;
use App\ClientsToTickets;
use App\TraningToTrainer;
use App\VisitedClients;
use Carbon\Carbon;

class EventModel
{
    protected $id_event;

    protected $client;

    protected $ticket;

    protected $eventEventIdFromDB;

    protected $getActiveTickets;

    protected $thisTrainingNoAccess = 'Клієнт був відмічений на це заняття';

    protected $notTicket = 'Клієнт немає доступних абонементів';

    protected $doneTicket = 'Клієнту відмічений абонемент';

    public function __construct(Client $client){
        $this->client = $client;
    }

    public function saveToEvent($id_event){
        $this->id_event = $id_event;
        $this->eventEventIdFromDB = $this->getIdEventFromDB();
        $this->getActiveTickets = $this->hasActiveTicketClient();
        if (isset($this->getActiveTickets)){
            if($ticket = $this->findActivitiesTicket(2)){
                $this->ticket = $ticket;
                if($this->getTimeVisited()){
                    return [
                        'error'=> $this->thisTrainingNoAccess,
                    ];
                }
                $this->checkAccess();
                return [
                    'status'=>$this->doneTicket,
                    'countAllTicketAccess' => $this->countAllTicketAccess()
                ];
            }

            if($ticket = $this->findActivitiesTicket(1)){
                $this->ticket = $ticket;
                if($this->getTimeVisited()){
                    return [
                        'error'=>$this->thisTrainingNoAccess,
                    ];
                }
                $this->statusTicketActive();
                $this->checkAccess();
                return [
                    'status'=>$this->doneTicket,
                    'countAllTicketAccess' => $this->countAllTicketAccess()
                ];
            }

        }else{
            return [
                'error'=>$this->notTicket,
            ];
        }
    }

    /**
     * Повертає ІД з кешованого календаря
     * @return int
     */
    public function getIdEventFromDB(){
        return TraningToTrainer::where('id_events', $this->id_event)->get()->first();
    }

    /**
     * Повертає кількість доступних занять у всіх абонементах
     * @return int
     */
    public function countAllTicketAccess(){
        $openEvents = 0;
        foreach($this->hasActiveTicketClient() as $activeTicket){
            if($activeTicket->statusTicket_id < 3){
                $this->ticket = $activeTicket;
                $openEvents +=$activeTicket->getNameTicket->qtySessions - $this->countVisited();
            }
        }
        return $openEvents;
    }

    /**
     * Повертає кількість доступних занять у даному абонементі
     * @param $id_ticket
     * @return mixed
     */
    public function countTicketAccess($id_ticket){
        $this->ticket = $id_ticket;
        $openEvents = $this->ticket->getNameTicket->qtySessions - $this->countVisited();
        return $openEvents;
    }

    /**
     * Повертає обєкт активного абонемента
     * @return mixed
     */
    private function hasActiveTicketClient(){
        return $this->client->getActiveTickets;
    }

    /**
     * Шукає абонементи
     * @param $status
     * @return int
     */
    private function findActivitiesTicket($status){
        $ticket = 0;
        foreach($this->getActiveTickets as $getActiveTicket){
            if($getActiveTicket->statusTicket_id == $status){
                $ticket = $getActiveTicket;
                break;
            }
        }
        return $ticket;
    }

    /**
     * Перевіряє статуси абонементів
     */
    private function checkAccess(){
        $countVisited = $this->countVisited();
        if($countVisited < $this->ticket->getNameTicket->qtySessions){
            $this->clientVisiting();
            if($countVisited == $this->ticket->getNameTicket->qtySessions-1){
                $this->statusTicketLocked();
            }
        }else{
            $this->statusTicketLocked();
        }
    }

    /**
     * Повертає кількість разів які клієнт відвідав по абонементу
     * @return mixed
     */
    private function countVisited(){
        return VisitedClients::where('ticket_id',$this->ticket->id)->get()->count();
    }

    /**
     * Перевіряє на дублювання запису клієнта до занняття
     * @return mixed
     */
    private function getTimeVisited(){
        return VisitedClients::where('training_id', $this->eventEventIdFromDB->id)->where('ticket_id', $this->ticket->id)->get()->count();
    }

    /**
     * Запис в БД сліента котрий прийшов на заняття
     */
    private function clientVisiting(){
        VisitedClients::create([
            'training_id' => $this->eventEventIdFromDB->id,
            'ticket_id' => $this->ticket->id,
        ]);
    }

    /**
     * Виставляє статус закритий абонемент
     */
    private function statusTicketLocked(){
        $this->ticket->statusTicket_id = 3;
        $this->ticket->update();
    }

    /**
     * Виставляє статус активний абонемент
     */
    private function statusTicketActive(){
        $this->ticket->statusTicket_id = 2;
        $this->ticket->dateFromReserve = Carbon::now()->addDays($this->ticket->getNameTicket->activityTime);
        $this->ticket->update();
    }

    public function getAllTrainingOfClient(){
        $trainings = [];
        foreach($this->client->getAllTickets as $ticket){
            foreach($ticket->getTrainings as $training){
                $trainings[] = [
                    'title' => $training->getDetailTraining->name,
                    'start' => $training->getDetailTraining->start,
                    'end' => $training->getDetailTraining->end,
                    'id' => $training->getDetailTraining->id_events,
                    'description' => $training->getDetailTraining->description,
                    'trainer' => $training->getDetailTraining->getNameTrainer->name
                ];
            }

        }
        return $trainings;
    }
}

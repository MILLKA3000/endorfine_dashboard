<?php

namespace App\Http\Controllers;

use App\ClientsToTickets;
use App\Ticket;
use App\TraningToTrainer;
use App\VisitedClients;
use Illuminate\Http\Request;

use App\Http\Requests;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function addEvents(Request $request)
    {
        $this->eventEventIdFromDB = TraningToTrainer::where('id_events', $request->id_event)->get()->first();
        $getActiveTickets = ClientsToTickets::where('client_id',$request->id_client)->where('statusTicket_id','<',3)->get();
        if (isset($getActiveTickets)){

            if($this->ticket = $this->findActivitiesTicket($getActiveTickets,2)){
                $this->checkAccess();

            }elseif($this->ticket = $this->findActivitiesTicket($getActiveTickets,1)){
                $this->statusTicketActive();
                $this->addVisitedTable();
                if($this->hasVisited() == $this->ticket->getNameTicket->qtySessions-1){
                    $this->statusTicketLocked();
                }
            }
        }
        return "ok";
    }

//    TO MODELS LATER

    private function findActivitiesTicket($getActiveTickets,$id){
        $ticket = 0;
        foreach($getActiveTickets as $getActiveTicket){
            if($getActiveTicket->statusTicket_id == $id){
                $ticket = $getActiveTicket;
                break;
            }
        }
        return $ticket;
    }

    private function checkAccess(){
        $countVisited = $this->hasVisited();
        if($countVisited < $this->ticket->getNameTicket->qtySessions){
            $this->addVisitedTable();
            if($countVisited == $this->ticket->getNameTicket->qtySessions-1){
                $this->statusTicketLocked();
            }
        }else{
            $this->statusTicketLocked();
        }
    }

    private function hasVisited(){
        return VisitedClients::where('ticket_id',$this->ticket->id)->get()->count();
    }

    private function addVisitedTable(){
        VisitedClients::create([
            'training_id' => $this->eventEventIdFromDB->id,
            'ticket_id' => $this->ticket->id,
        ]);
    }

    private function statusTicketLocked(){
        $this->ticket->statusTicket_id = 3;
        $this->ticket->update();
    }

    private function statusTicketActive(){
        $this->ticket->statusTicket_id = 2;
        $this->ticket->update();
    }
}

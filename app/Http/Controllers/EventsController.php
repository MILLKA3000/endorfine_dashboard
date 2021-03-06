<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientsToTickets;
use App\Models\Events\EventModel;
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

        $events = new EventModel(Client::find($request->id_client));
        $response = $events->saveToEvent($request->id_event);
        $response['calendar'] = $events->getAllTrainingOfClient();
        return json_encode($response);
    }

    public function deleteEvents(Request $request)
    {

        $events = new EventModel(Client::find($request->id_client));
        $response = $events->delEvent($request->id_event);
        $response['calendar'] = $events->getAllTrainingOfClient();
        return json_encode($response);
    }


}

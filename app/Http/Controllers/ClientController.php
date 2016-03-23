<?php

namespace App\Http\Controllers;

use App\ClientStatuses;
use App\ClientsToTickets;
use App\Discounts;
use App\Http\Requests\Client\ClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

use Yajra\Datatables\Facades\Datatables;

class ClientController extends Controller
{

    protected $client;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('client.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = ClientStatuses::all();
        $tickets = Ticket::all();
        $discounts = Discounts::whereIn('status',[2,3])->get();
        $lastTicket = (clientsToTickets::get()->last())?clientsToTickets::get()->last()->id+1:1;
        return view('client.create_edit', compact('statuses','tickets','discounts','lastTicket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $client = new Client ();
        $client->fill($request->toArray());
        $client->save();
        $this->client = $client->id;
        $client->update($this->getPhoto($request->photo));

        $ticket = new ClientsToTickets();
        $ticket->ticket_id = $request->ticket;
        $ticket->client_id = $client->id;
        $ticket->statusTicket_id = 1;
        $ticket->discount_id = $request->discount;
        $ticket->numTicket = $request->numTicket;
        $ticket->save();

        return redirect('/clients');
    }

    /**
     *
     * @param Client $client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $statuses = ClientStatuses::all();
        $client = Client::find($id);
        return view('client.details_client',compact('client','statuses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function joinToUser(Client $client)
    {
        $tickets = Ticket::all();
        $discounts = Discounts::whereIn('status',[2,3])->get();
        return view('client.joinToUser', compact('client','tickets','discounts'));
    }

    public function saveTicketClient(Request $request, Client $client)
    {
        $ticket = new ClientsToTickets();
        $ticket->ticket_id = $request->ticket;
        $ticket->client_id = $client->id;
        $ticket->statusTicket_id = 1;
        $ticket->discount_id = $request->discount;
        $ticket->numTicket = $client->getActiveTickets->first()->numTicket;
        $ticket->save();

        return redirect('/clients/'.$client->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $this->client = $client->id;
        $request->photo = $this->getPhoto($request->photo)['photo'];
        $client->update($request->toArray());
        return redirect('/clients/'.$client->id);
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

    private function getPhoto($im)
    {
        $path = '/photo/' . $this->client . '.png';
        if(!empty($im)) {
            $ifp = fopen(public_path() . $path, "wb");
            $data = explode(',', $im);
            fwrite($ifp, base64_decode($data[1]));
            fclose($ifp);
        }
        return ['photo'=>$path];
    }

    public function data()
    {
        $clients = Client::select('id', 'photo', 'name','phone','detail','detail as discount','status_id','enabled')->get();

        return Datatables::of($clients)
            ->edit_column('status_id', function($client){
                return $client->getNameStatus->name;
            })
            ->edit_column('detail', function($client){
                $tickets = '';
                $client->discount = $client->getNameStatus->getNameDiscountForClients;
                foreach($client->getActiveTickets as $ticket){
                    $tickets.= $ticket->getNameTicket->name.' <br/>';
                    $client->discountTicket = $ticket->getNameDiscountForTicket;
                }
                return $tickets;
            })
            ->edit_column('discount', function($client){
                $discounts = '';
                if (isset($client->discount))
                    if ($client->discount->percent>0)
                        $discounts = '<small class="label label-warning">'.$client->discount->name.' - '.$client->discount->percent.'%</small><br/>';
                if (isset($client->discountTicket))
                    if ($client->discountTicket->percent>0)
                        $discounts .= '<small class="label label-warning">'.$client->discountTicket->name.' - '.$client->discountTicket->percent.'%</small><br/>';
                return $discounts .= '<small class="label label-success"> Загальна: '.($client->discount->percent + ((isset($client->discountTicket))?$client->discountTicket->percent:0)).'%</small>';
            })
            ->edit_column('photo', function($client){
                return "<img class='photo_mic' src='/photo/$client->id.png' width='50'>";
            })
            ->edit_column('enabled', '@if ($enabled=="1") <span class=\'glyphicon text-green glyphicon-ok\'></span> @else <span class=\'glyphicon text-red glyphicon-remove\'></span> @endif')

            ->add_column('actions', '<a href="{{{ URL::to(\'clients/\' . $id ) }}}" class="btn btn-success btn-sm " ><span class="glyphicon glyphicon-pencil"></span>   </a>
                    <a href="{{{ URL::to(\'clients/\' . $id . \'/destroy\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }

    public function getAllTickets(Client $client)
    {

        $tickets = ClientsToTickets::select('id', 'ticket_id','ticket_id as qty','ticket_id as activityTime','discount_id','statusTicket_id')->where('client_id',$client->id)->where('ticket_id','>','1')->get();

        return Datatables::of($tickets)
            ->edit_column('ticket_id', function($ticket){
                return $ticket->getNameTicket->name;
            })
            ->edit_column('qty', function($ticket){
                return $ticket->getNameTicket->qtySessions;
            })
            ->edit_column('activityTime', function($ticket){
                $dateTime = new Carbon($ticket->created_at);
                return $dateTime->addDays($ticket->getNameTicket->activityTime)->format('j - m - Y');
            })
            ->edit_column('discount_id', function($ticket){
                return '<small class=\'label label-success\'>'.$ticket->getNameDiscountForTicket->name.' - '.$ticket->getNameDiscountForTicket->percent.'%</small>';
            })
            ->edit_column('statusTicket_id', function($ticket){
                return $ticket->getStatusTicket->name;
            })
            ->add_column('actions', '<a href="{{{ URL::to(\'clients/\' . $id ) }}}" class="btn btn-success btn-sm " ><span class="glyphicon glyphicon-pencil"></span>   </a>
                    <a href="{{{ URL::to(\'clients/\' . $id . \'/destroy\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }
}

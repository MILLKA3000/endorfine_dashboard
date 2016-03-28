<?php

namespace App\Http\Controllers;

use App\ClientStatuses;
use App\ClientsToTickets;
use App\ClientToService;
use App\Discounts;
use App\Http\Requests\Client\ClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\Calendar\GetAllCalendarsModel;
use App\Models\Calendar\GetAllEventsaModel;
use App\Services;
use App\StatusesTicket;
use App\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

use Yajra\Datatables\Facades\Datatables;

class ClientController extends Controller
{

    protected $client;

    public function index()
    {
        return view('client.index');
    }

    public function create()
    {
        $statuses = ClientStatuses::all();
        $tickets = Ticket::all()->where('enabled',1);
        $discounts = Discounts::whereIn('status',[2,3])->get();
        $lastTicket = (clientsToTickets::get()->last())?clientsToTickets::get()->last()->id+1:1;
        return view('client.create_edit', compact('statuses','tickets','discounts','lastTicket'));
    }

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

    private function getActiveTraning(){
        $modelEvents = new GetAllCalendarsModel();
        $traning = $modelEvents->getAllEventsOfTrainers([
            'timeMin'=> Carbon::parse("this day")->subMinutes(25)->toRfc3339String(),
            'timeMax'=> Carbon::parse("this day")->toDateString()."T23:59:59+00:00",
        ]);

        $traningFormated = $modelEvents->reformatedEvents(true);

        $activeTraning = array_first($traningFormated, function($key, $value)
        {
            if(Carbon::parse($value['start']) >= Carbon::parse("this day")->subMinute(50)) {
                return $value['id'];
            }
        });

        return compact('traningFormated','activeTraning');
    }


    public function show($id)
    {

        $training = $this->getActiveTraning();
        $traningFormated = $training['traningFormated'];
        $activeTraning = $training['activeTraning'];

        $statuses = ClientStatuses::all();
        $client = Client::find($id);
        $active = 'activity';
        return view('client.details_client',compact('client','statuses','active','traningFormated','activeTraning'));
    }

    public function joinService(Client $client)
    {
        $training = $this->getActiveTraning();
        $traningFormated = $training['traningFormated'];
        $activeTraning = $training['activeTraning'];

        $service = Services::all();
        return view('client.joinService', compact('client','service','traningFormated','activeTraning'));
    }

    public function joinTicket(Client $client)
    {
        $training = $this->getActiveTraning();
        $traningFormated = $training['traningFormated'];
        $activeTraning = $training['activeTraning'];

        $tickets = Ticket::all()->where('enabled',1);
        $discounts = Discounts::whereIn('status',[2,3])->get();
        return view('client.joinTicket', compact('client','tickets','discounts','traningFormated','activeTraning'));
    }

    public function saveServiceClient(Request $request, Client $client)
    {
        $dateTime = new Carbon();
        $service = new ClientToService();
        $service->client_id = $client->id;
        $service->service_id = $request->service;
        $service->endDateForUse = $dateTime->addDays(Services::find($service->service_id)->activityTime);
        $service->save();

        return redirect('/clients/'.$client->id.'?active=service');
    }

    public function saveTicketClient(Request $request, Client $client)
    {
        $ticket = new ClientsToTickets();
        $ticket->ticket_id = $request->ticket_id;
        $ticket->client_id = $client->id;
        $ticket->statusTicket_id = 1;
        $ticket->discount_id = $request->discount_id;
        $ticket->numTicket = $client->getActiveTickets->first()->numTicket;
        $ticket->save();

        return redirect('/clients/'.$client->id);
    }

    public function editTicketClient(ClientsToTickets $activeTicket){
        $discounts = Discounts::whereIn('status',[2,3])->get();
        $client = Client::find($activeTicket->client_id);
        $tickets = Ticket::all()->where('enabled',1);
        $statusTicket = StatusesTicket::all();
        return view('client.joinTicket', compact('activeTicket','discounts','statusTicket','tickets','client'));
    }

    public function updateTicketClient(Request $request, ClientsToTickets $activeTicket){
        $activeTicket->update($request->toArray());
        return redirect('/clients/'.$activeTicket->client_id);
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $this->client = $client->id;
        $request->photo = $this->getPhoto($request->photo)['photo'];
        $client->update($request->toArray());
        return redirect('/clients/'.$client->id);
    }

    public function destroy(Client $client)
    {
        ClientsToTickets::where('client_id',$client->id)->update(['numTicket'=>null]);
        $client->delete();
        return redirect()->back();
    }

    public function destroyServiceClient(ClientToService $service)
    {
        $service->delete();
        return redirect((str_contains(URL::previous(), '?active=service')?URL::previous():URL::previous().'?active=service'));
    }

    public function destroyTicketClient(ClientsToTickets $ticket)
    {
        $ticket->delete();
        return redirect()->back();
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
        $clients = Client::select('id','id as numID', 'photo', 'name','phone','detail','detail as discount','status_id','enabled')->get();

        return Datatables::of($clients)
            ->edit_column('numID', function($client){
                return $client->getNumTicket->numTicket;
            })
            ->edit_column('status_id', function($client){
                return $client->getNameStatus->name;
            })
            ->edit_column('detail', function($client){
                $tickets = '';
                $client->discount = $client->getNameStatus->getNameDiscountForClients;
                foreach($client->getActiveTickets as $ticket){
                    if($ticket->hasEnabled) {
                        $tickets .= $ticket->getNameTicket->name . ' <br/>';
                        $client->discountTicket = $ticket->getNameDiscountForTicket;
                    }
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

        $tickets = ClientsToTickets::select('clientsToTickets.id', 'ticket_id','ticket_id as qty','ticket_id as activityTime','discount_id','statusTicket_id')
            ->join('tickets', 'clientsToTickets.ticket_id', '=', 'tickets.id')
            ->where('clientsToTickets.client_id',$client->id)
            ->where('tickets.enabled',1)
            ->get();

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
            ->add_column('actions', '<a href="{{{ URL::to(\'clients/\' . $id.\'/updateTicketClient\' ) }}}" class="btn btn-success btn-sm " ><span class="glyphicon glyphicon-pencil"></span>   </a>
                    <a href="{{{ URL::to(\'clients/\' . $id . \'/destroyTicketClient\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }

    public function getAllService(Client $client)
    {

        $tickets = ClientToService::select('id', 'service_id','endDateForUse')->where('client_id',$client->id)->get();

        return Datatables::of($tickets)
            ->edit_column('service_id', function($ticket){
                return $ticket->getService->name;
            })
            ->edit_column('endDateForUse', function($ticket){
                return ($ticket->endDateForUse >= date('Y-m-d')) ? '<span style="color:green">'.$ticket->endDateForUse.'</span>' : '<span style="color:red">'.$ticket->endDateForUse.'</span>';
            })
            ->add_column('actions', '<a href="{{{ URL::to(\'clients/\' . $id . \'/destroyServiceClient\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }
}

<?php

namespace App\Http\Controllers;

use App\ClientStatuses;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;
use Yajra\Datatables\Facades\Datatables;

class ClientController extends Controller
{
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
        return view('client.create_edit', compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = new Client ();
        $status->fill($request->toArray());
        $status->save();
        return redirect('/clients');
    }

    /**
     *
     * @param Client $client
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Client $client)
    {
        return view('client.details_client',compact('client'));
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

    public function getPhoto()
    {
        $im = $_POST['image'];
        $ifp = fopen(public_path().'/photo/image.png', "wb");

        $data = explode(',', $im);

        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);



    }

    public function data()
    {
        $clients = Client::select('id', 'photo', 'name','phone','detail','birthday','status_id','enabled')->get();

        return Datatables::of($clients)
            ->edit_column('status_id', function($client){
                return $client->getNameStatus->name;
            })
            ->edit_column('photo', function($client){
                return "<img src='/photo/image.png' width='50'>";
            })
            ->edit_column('enabled', '@if ($enabled=="1") <span class=\'glyphicon text-green glyphicon-ok\'></span> @else <span class=\'glyphicon text-red glyphicon-remove\'></span> @endif')

            ->add_column('actions', '<a href="{{ URL::to(\'tickets/statuses/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm " ><span class="glyphicon glyphicon-pencil"></span>   </a>
                    <a href="{{{ URL::to(\'tickets/statuses/\' . $id . \'/destroy\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }
}

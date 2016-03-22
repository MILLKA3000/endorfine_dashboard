<?php

namespace App\Http\Controllers;

use App\ClientStatuses;
use App\Discounts;
use App\Http\Requests\NameRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Facades\Datatables;

class ClientStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('statuses.clients.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $discount = Discounts::whereIn('status',[1,3])->get();
        return view('statuses.clients.create_edit', compact('discount'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NameRequest $request)
    {
        $status = new ClientStatuses ();
        $status->fill($request->toArray());
        $status->save();
        return redirect('/clients/statuses');
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
    public function edit(ClientStatuses $status)
    {
        $discount = Discounts::whereIn('status',[1,3])->get();
        return view('statuses.clients.create_edit', compact('status','discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NameRequest $request, ClientStatuses $status)
    {
        $status->update($request->toArray());
        return redirect('/clients/statuses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientStatuses $status)
    {
        $status->delete();
        return redirect('/clients/statuses');
    }

    public function data()
    {
        $statuses = ClientStatuses::select('id','name','discount_id','created_at')->get();

        return Datatables::of($statuses)
            ->edit_column('discount_id', function($status){
                return $status->getNameDiscountForClients->name." ( <span class='text-green'>".$status->getNameDiscountForClients->percent."%</span> )";
            })
            ->add_column('actions', '<a href="{{ URL::to(\'clients/statuses/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm " ><span class="glyphicon glyphicon-pencil"></span>   </a>
                    <a href="{{{ URL::to(\'clients/statuses/\' . $id . \'/destroy\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }
}

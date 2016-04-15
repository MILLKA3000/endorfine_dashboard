<?php

namespace App\Http\Controllers;

use App\Http\Requests\NameRequest;
use App\StatusesTicket;
use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Facades\Datatables;

class StatusTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('statuses/tickets/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('statuses.tickets.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NameRequest $request)
    {
        try
        {
            $status = new StatusesTicket($request->toArray());
            $status->save();
        }
        catch(\Exception $e) {
            return view('exceptions.msg')->with('msg', ' Зміни не збережено');
        }
        
        return redirect('/tickets/statuses');
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
    public function edit(StatusesTicket $status)
    {
        return view('statuses.tickets.create_edit', compact('status'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(NameRequest $request, StatusesTicket $status)
    {
        try
        {
            $status->update($request->toArray());
        }
        catch(\Exception $e) {
            return view('exceptions.msg')->with('msg', ' Зміни не збережено');
        }
        
        return redirect('/tickets/statuses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StatusesTicket $status)
    {
        $status->delete();
        return redirect('/tickets/statuses');
    }

    public function data()
    {
        $statuses = StatusesTicket::select('id', 'name', 'created_at')->get();
        return Datatables::of($statuses)
            ->add_column('actions', '<a href="{{ URL::to(\'tickets/statuses/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm " ><span class="glyphicon glyphicon-pencil"></span>   </a>
                    <a href="{{{ URL::to(\'tickets/statuses/\' . $id . \'/destroy\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }

}

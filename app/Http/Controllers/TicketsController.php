<?php

namespace App\Http\Controllers;

use App\Discounts;
use App\Http\Requests\Tickets\TicketsRequest;
use App\Ticket;
use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Facades\Datatables;


class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.tickets.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketsRequest $request)
    {
        try
        {
            $status = new Ticket($request->toArray());
            $status->save();
        }
        catch(\Exception $e) {
            return view('exceptions.msg')->with('msg', ' Зміни не збережено');
        }
        
        return redirect('tickets');
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
    public function edit(Ticket $ticket)
    {
        return view('clients.tickets.create_edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Ticket $ticket, TicketsRequest $request)
    {
        try
        {
            $ticket->update($request->toArray());
        }
        catch(\Exception $e) {
            return view('exceptions.msg')->with('msg', ' Зміни не збережено');
        }
        
        return redirect('tickets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect()->back();
    }

    public function data()
    {
        $tickets = Ticket::select('id', 'name', 'qtySessions', 'activityTime', 'value', 'enabled')->get();
        return Datatables::of($tickets)

            ->edit_column('enabled', '@if ($enabled=="1") <span class=\'glyphicon text-green glyphicon-ok\'></span> @else <span class=\'glyphicon text-red glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{ URL::to(\'tickets/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm " ><span class="glyphicon glyphicon-pencil"></span>   </a>
                    <a href="{{{ URL::to(\'tickets/\' . $id . \'/destroy\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }
}

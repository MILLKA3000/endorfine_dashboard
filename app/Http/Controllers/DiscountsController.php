<?php

namespace App\Http\Controllers;

use App\Discounts;
use App\Http\Requests\Discounts\DiscountRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Facades\Datatables;

class DiscountsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clients.discounts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.discounts.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountRequest $request)
    {
        $status = new Discounts($request->toArray());
        $status->save();
        return redirect('/discounts');
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
    public function edit(Discounts $discount)
    {
        return view('clients.discounts.create_edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Discounts $discount, DiscountRequest $request)
    {

        $discount->update($request->toArray());
        return redirect('discounts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discounts $discount)
    {
        $discount->delete();
        return redirect('discounts');
    }

    /**
     * @return mixed
     */
    public function data()
    {
        $discounts = Discounts::select('id', 'name', 'detail', 'percent', 'status', 'enabled')->get();
        return Datatables::of($discounts)
            ->edit_column('enabled', '@if ($enabled=="1") <span class=\'glyphicon text-green glyphicon-ok\'></span> @else <span class=\'glyphicon text-red glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{ URL::to(\'discounts/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm " ><span class="glyphicon glyphicon-pencil"></span>   </a>
                    <a href="{{{ URL::to(\'discounts/\' . $id . \'/destroy\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }
}

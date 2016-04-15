<?php

namespace App\Http\Controllers;

use App\Discounts;
use App\Http\Requests\Discounts\DiscountRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Facades\Datatables;

class DiscountsController extends Controller
{
    protected $listStatuses=[1=>'Клієнт', 2=>'Абонемент', 3=>'Всі'];
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
        $status = $this->listStatuses;
        return view('clients.discounts.create_edit', compact('status'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountRequest $request)
    {
        try
        {
            $status = new Discounts($request->toArray());
            $status->save();
        }
        catch(\Exception $e) {
            return view('exceptions.msg')->with('msg', ' Зміни не збережено');
        }
        
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
        $status = $this->listStatuses;
        return view('clients.discounts.create_edit', compact('discount','status'));
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
        try
        {
            $discount->update($request->toArray());
        }
        catch(\Exception $e) {
            return view('exceptions.msg')->with('msg', ' Зміни не збережено');
        }
        
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
            ->edit_column('status', function($discount){
                return $this->listStatuses[$discount->status];
            })
            ->edit_column('enabled', '@if ($enabled=="1") <span class=\'glyphicon text-green glyphicon-ok\'></span> @else <span class=\'glyphicon text-red glyphicon-remove\'></span> @endif')
            ->add_column('actions', '<a href="{{ URL::to(\'discounts/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm " ><span class="glyphicon glyphicon-pencil"></span>   </a>
                    <a href="{{{ URL::to(\'discounts/\' . $id . \'/destroy\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }
}

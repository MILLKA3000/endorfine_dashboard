<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Options;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class OptionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Options::get();
        return view('system_options.index', compact('options'));
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
    public function save(Request $request)
    {
        dd($request);
        if ($request->hasFile('logo')) {
            dd(1);
        }
        $options = $request->except('_token');
        foreach ($options as $key => $value){
            !empty($value) ? Options::where('key', $key)->update(['value' => $value]) : '';
        }
        return redirect('/options');
    }

    public function fileUpload()
    {
        dd();
    }
}

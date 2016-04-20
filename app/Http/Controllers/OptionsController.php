<?php

namespace App\Http\Controllers;

use App\OptionsForChapters;
use Illuminate\Http\Request;
use App\Options;
use App\Http\Requests;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class OptionsController extends Controller
{
    private $logoFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = Options::get();
        $optionsGroupArray = [];
        foreach ($options as $optionsArray)
        {
            $optionsGroupArray[$optionsArray->group][] = $optionsArray;
        }
        return view('system_options.index', compact('optionsGroupArray'));
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
    public function save(Requests\Options $request)
    {
//        whereIdOptions(Options::getIdForOptions($key))
//            ->whereIdChapter(Cache::get('chapterActive'))
//            ->

        try
        {
            if ($request->hasFile('logo')) {
                $this->logoFile = $request->file('logo');
                $this->fileUpload();
            }
            $options = $request->except('_token');
            OptionsForChapters::whereIdChapter(Cache::get('chapterActive'))->delete();
            foreach ($options as $key => $value) {
                if(!empty($value))
                {
                    OptionsForChapters::create(
                        ['id_options' => Options::getIdForOptions($key),
                        'id_chapter' => intval(Cache::get('chapterActive')),
                        'value' => $value,
                        'array_permissions' => 1]
                    );
                }
            }
        }
        catch(\Exception $e) {
            return view('exceptions.msg')->with('msg', ' Налаштування не збережено');
        }
        
        return redirect('/options');
    }

    public function fileUpload()
    {
        $this->logoFile->move(public_path() . DIRECTORY_SEPARATOR .'img', 'logo.png');
    }
    
}

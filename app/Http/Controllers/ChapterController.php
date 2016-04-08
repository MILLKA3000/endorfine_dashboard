<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\Http\Requests;
use Yajra\Datatables\Facades\Datatables;

class ChapterController extends Controller
{
    public function index()
    {
        return view('chapters.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('chapters.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\Chapter $request)
    {
        $chapter = new Chapter($request->toArray());
        $chapter->save();
        return redirect('/chapters');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Chapter $chapter
     * @return Response
     * @internal param $user
     */
    public function edit($id)
    {
        $chapter = Chapter::find($id);
        return view('chapters.create_edit', compact('chapter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ChapterRequest|UserRequest $request
     * @param Chapter|User $users
     * @return Response
     * @internal param $user
     */
    public function update(Requests\Chapter $request, $id)
    {
        $chapter = Chapter::find($id);
        $chapter->update($request->toArray());
        return redirect('/chapters');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function destroy($id)
    {
        if($id != 1) {
            return redirect('/chapters'); // after need add error box
        }
        $chapter = Chapter::find($id);
        $chapter->delete();

        return redirect('/chapters');
    }


    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getAllСhapters()
    {
        $chapter = Chapter::all(array('id', 'name', 'address', 'info'));

        return Datatables::of($chapter)
            ->add_column('actions', '<a href="{{ URL::to(\'chapters/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm " ><span class="glyphicon glyphicon-pencil"></span>   </a>
                    <a href="{{{ URL::to(\'chapters/\' . $id . \'/destroy\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }
}

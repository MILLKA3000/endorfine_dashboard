<?php

namespace App\Http\Controllers;

use App\Chapter;
use App\JoinTrainerToRoom;
use App\Room;
use App\Services\GoogleCalendar;
use App\User;
use Google_Service_Calendar_Calendar;
use Illuminate\Http\Request;

use App\Http\Requests;
use Yajra\Datatables\Facades\Datatables;

class RoomController extends Controller
{
    public function index()
    {
        return view('rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $getAllTrainer = User::getTrainers();
        $trainerAllowed = User::where('id',0)->get();
        $chapters = Chapter::all();
        return view('rooms.create_edit',compact('chapters','getAllTrainer','trainerAllowed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\Room $request)
    {
        try
        {
            $room = new Room($request->toArray());
            $room->save();
            foreach($request->trainerAllowed as $trainer){
                $trainer = User::find($trainer);
                $calendar_service = new GoogleCalendar();
                $calendar = $calendar_service->setNewCalendar($room,$trainer);
                if($calendar) {
                    JoinTrainerToRoom::create([
                        'room_id' => $room->id,
                        'trainer_id' => $trainer->id,
                        'room_calendar_id' => $calendar,
                        'name' => $trainer->name.":".$room->name
                    ]);
                }
            }
        }
        catch(\Exception $e) {
            return view('exceptions.msg')->with('msg', ' Зміни не збережено');
        }
        
        return redirect('/rooms');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     * @internal param Chapter $chapter
     * @internal param $user
     */
    public function edit($id)
    {
        $chapters = Chapter::all();
        $room = Room::find($id);
        $trainerAllowed = User::whereIn('id',$room->getAllowedTrainers->lists('trainer_id'))->whereRoleId(3)->get();
        $getAllTrainer = User::whereNotIn('id',$room->getAllowedTrainers->lists('trainer_id'))->whereRoleId(3)->get();
        return view('rooms.create_edit', compact('room','chapters','getAllTrainer','trainerAllowed'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ChapterRequest|UserRequest|Requests\Room $request
     * @param $id
     * @return Response
     * @internal param Chapter|User $users
     * @internal param $user
     */
    public function update(Requests\Room $request, $id)
    {
        try
        {
            $room = Room::find($id);
            $room->update($request->toArray());
            $trainersAllowed = JoinTrainerToRoom::whereRoomId($id)->get();
            foreach($request->trainerAllowed as $trainer){
                $trainer = User::find($trainer);
                $calendar_service = new GoogleCalendar();
                if(in_array($trainer->id,$trainersAllowed->lists('trainer_id')->toArray())==false){
                    $calendar = $calendar_service->setNewCalendar($room,$trainer);
                    if($calendar) {
                        JoinTrainerToRoom::create([
                            'room_id' => $room->id,
                            'trainer_id' => $trainer->id,
                            'room_calendar_id' => $calendar,
                            'name' => $trainer->name.":".$room->name
                        ]);
                    }
                }else{
                    $calendar = $calendar_service->destroyCalendar($room,$trainer);
                    if($calendar) {
                        JoinTrainerToRoom::whereTrainerId($trainer->id)->whereRoomId($id)->destroy();
                    }
                }
            }
        }
        catch(\Exception $e) {
            return view('exceptions.msg')->with('msg', ' Зміни не збережено');
        }
        
        return redirect('/rooms');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return Response
     * @internal param $user
     */
    public function destroy($id)
    {
        if($id != 1) {
            return redirect('/rooms'); // after need add error box
        }
        $room = Room::find($id);
        $room->delete();
        return redirect('/rooms');
    }


    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function getAllRooms()
    {
        $room = Room::select(array('id', 'name','chapter_id', 'info'))->orderBy('chapter_id','ASC')->get();

        return Datatables::of($room)
            ->edit_column('chapter_id', function($room){
                return $room->getNameChapter->name;
            })
            ->add_column('actions', '<a href="{{ URL::to(\'rooms/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm " ><span class="glyphicon glyphicon-pencil"></span>   </a>
                    <a href="{{{ URL::to(\'rooms/\' . $id . \'/destroy\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }
}

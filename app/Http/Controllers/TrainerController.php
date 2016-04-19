<?php

namespace App\Http\Controllers;

use App\Http\Requests\Trainer\TrainerRequest;
use App\Http\Requests\UserRequest;
use App\PaymentsVariables;
use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Yajra\Datatables\Facades\Datatables;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('trainers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::getTrainer();
        return view('trainers.create_edit', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        $user = new User ($request->except('password','password_confirmation'));
        $user->password = bcrypt($request->password);
        $user->confirmation_code = str_random(32);
        $user->role_id = $request->role_id;
        $user->enabled = $request->enabled;
        $user->save();
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
    public function edit($id)
    {
        $trainer = User::find($id);
        $roles = Role::getTrainer();
        return view('trainers.create_edit', compact('roles','trainer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TrainerRequest|Request $request
     * @param User $user
     * @return \Illuminate\Http\Response
     * @internal param int $id
     */
    public function update(TrainerRequest $request, User $user, PaymentsVariables $payments )
    {
        
        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;
        $user->role_id = $request->role_id;
        $user->enabled = $request->enabled;
        $payments->min = $request->min;
        $payments->value = $request->value;
        $payments->type_id = $request->type_id;
        
        try
        {
            if (!empty($password)) {
                if ($password === $passwordConfirmation) {
                    $user->password = bcrypt($password);
                }
            }
            $user->update($request->toArray());
            $payments->update($request->toArray());
        }
        catch(\Exception $e) {
            return view('exceptions.msg')->with('msg', ' Зміни не збережено');
        }

        return redirect('trainers');
       
        
    }

    public function getAllTrainers(){
        $users = User::getTrainers();
        return Datatables::of($users)
            ->add_column('actions', '<a href="{{ URL::to(\'trainers/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm " ><span class="glyphicon glyphicon-pencil"></span>   </a>
                    <a href="{{{ URL::to(\'users/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }
}

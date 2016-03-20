<?php

namespace App\Http\Controllers;
use App\Role;
use App\User;
use Illuminate\Http\Request;

use Yajra\Datatables\Facades\Datatables;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    /*
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
        // Show the page
        return view('users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create_edit', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(UserRequest $request)
    {

        $user = new User ($request->except('password','password_confirmation'));
        $user->password = bcrypt($request->password);
        $user->confirmation_code = str_random(32);
        $user->role_id = $request->role_id;
        $user->enabled = $request->enabled;

        $user->save();
        return redirect('/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.create_edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $users
     * @return Response
     * @internal param $user
     */
    public function update(UserRequest $request, User $users)
    {

        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;
        $users->role_id = $request->role_id;
        $users->enabled = $request->enabled;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $users->password = bcrypt($password);
            }
        }
        $users->update();

        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $user
     * @return Response
     */

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->back();
    }


    /**
     * Show a list of all the languages posts formatted for Datatables.
     *
     * @return Datatables JSON
     */
    public function data()
    {
        $users = User::all(array('users.id', 'users.name', 'users.email', 'users.enabled', 'users.role_id', 'users.created_at'));

        return Datatables::of($users)
            ->edit_column('role_id', function($user){
                return $user->getNameRole->name;
            })
            ->edit_column('enabled', '@if ($enabled=="1") <span class=\'glyphicon text-green glyphicon-ok\'> Активний </span> @else <span class=\'glyphicon text-red glyphicon-remove\'> Деактивний </span> @endif')
            ->add_column('actions', '<a href="{{ URL::to(\'users/\' . $id . \'/edit\' ) }}" class="btn btn-success btn-sm " ><span class="glyphicon glyphicon-pencil"></span>   </a>
                    <a href="{{{ URL::to(\'users/\' . $id . \'/delete\' ) }}}" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-trash"></span> </a>')
            ->remove_column('id')
            ->make();
    }
}

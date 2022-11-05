<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $users = User::all()->load('roles');
//        return $users[0]->roles[0]->name;
        return Inertia::render('Backend/User/Index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        return Inertia::render('Backend/User/Create',compact('users', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserRequest $request)
    {
//        return $request;
//        dd ($request);
        $user = User::create([
            'name' => toWord($request->name),
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_active' => $request->get('is_active'),
        ]);
        if ($user){
            $role = Role::find($request->role_id['id']);
            $user->assignRole($role);
        }

        return redirect()->route('user.index');
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
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $user = User::find($id)->load('roles');
        $roles = Role::all();
        return Inertia::render('Backend/User/Update', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $role = $request->role_id ? Role::find($request->role_id) : Role::find($request->role_id['id']);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->is_active = $request->get('is_active', 1);
//        'is_admin' => $request->user()->hasRole('admin'),
//        $request->user()->hasRole($role);
//        $user->hasRole($role);
//        $user->assignRole($role);
//        return $user;
        $user->save();
        $user->syncRoles($role);
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
//        $user = User::find($id);
//        $user->delete();
        return redirect()->route('user.index');
    }


    public function sifreDegistir()
    {
        return Inertia::render('Auth/ResetPassword');
    }




}

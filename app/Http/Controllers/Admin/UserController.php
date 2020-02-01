<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::paginate(6);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id')->all();
        if ($roles) {
            return view('admin.users.create', compact('roles'));
        } else {
            return view('admin.users.create');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|unique:users',
            'role_id' => 'required|array'
        ]);
        $user = User::create($request->all());
        $user->password = bcrypt($request->password);

        $user->roles()->attach($request->role_id);
        $user->save();
        session()->flash('success', 'user created successfully!');
        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //
        $user = User::findOrFail($id);
        $role = Role::pluck('display_name', 'id')->all();
        return view('admin.users.edit', compact('user', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);
        $request->validate([
            'password' => 'required',
        ]);


        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),

        ]);
        $user->roles()->sync($request->role_id);

        session()->flash('success', 'user updated successfully!');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return responseJson(0, 'No data');
        }
        if (count($user->roles)) {
            return responseJson(0, 'do not remove this user,remove user’s role first');
        } else {
            $user->delete();
            return responseJson(1, 'User deleted Successfully!', $id);
        }
    }

    public function passForm()
    {
        $user = auth()->user();
        return view('admin.users.changePassword', compact('user'));
    }

    public function changePass(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',

        ]);
        $user = User::where('id', auth()->user()->id);
        $user->update([
            'password' => bcrypt($request->password)
        ]);

        session()->flash('success', 'password updated successfully!');
        return redirect()->route('users.index');
    }
}

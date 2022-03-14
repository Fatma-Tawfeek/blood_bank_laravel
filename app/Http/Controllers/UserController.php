<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = User::paginate(20);
        return view('users.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'roles_list' => 'required|array'
        ];
        $messages = [
            'name.required' => 'Name is required',
            'email' => 'Email is required',
            'password' => 'Password is required',
            'roles_list' => 'Roles are required'
        ];

        $this->validate($request, $rules, $messages);

        $request->merge(['password' => bcrypt($request->password)]);

        $record = User::create($request->except('roles_list'));
        $record->roles()->attach($request->input('roles_list'));

        flash()->success('User has been added Successfully!');

        return redirect(route('users.index'));
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
        $record = User::findOrFail($id);
        return view('users.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'email' => 'email|unique:users,email,'.$id,
            'password' => 'confirmed',
            'roles_list' => 'required|array'
        ];
        $messages = [
            'name.required' => 'Name is required',
            'email' => 'Email is required',
            'password' => 'Password is required',
            'roles_list' => 'Roles are required'
        ];

        $this->validate($request, $rules, $messages);

        $record = User::findOrfail($id);

        $request->merge(['password' => bcrypt($request->password)]);

        $record->update($request->all());
        $record->roles()->sync($request->roles_list);

        flash()->success('User has been updated Successfully!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = User::findOrFail($id);
        $record->delete();
        flash()->success('User has been deleted!');
        return back();
    }
}

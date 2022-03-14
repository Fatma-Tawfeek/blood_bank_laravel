<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = Role::paginate(20);
        return view('roles.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
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
            'name' => 'required|unique:roles,name',
            'permissions_list' => 'required|array'
        ];
        $messages = [
            'name.required' => 'Name is required',
            'permissions_list' => 'Permissions are required'
        ];

        $this->validate($request, $rules, $messages);

        $record = Role::create($request->except('permissions_list'));
        $record->permissions()->attach($request->input('permissions_list'));

        flash()->success('Role has been added Successfully!');

        return redirect(route('roles.index'));
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
        $record = Role::findOrFail($id);
        return view('roles.edit', compact('record'));
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
            'name' => 'required|unique:roles,name,'.$id,
            'permissions_list' => 'required|array'
        ];
        $messages = [
            'name.required' => 'Name is required',
            'permissions_list' => 'Permissions are required'
        ];

        $this->validate($request, $rules, $messages);

        $record = Role::findOrfail($id);
        $record->update($request->all());

        $record->permissions()->sync($request->permissions_list);

        flash()->success('Role has been updated Successfully!');
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
        $record = Role::findOrFail($id);
        $record->delete();
        flash()->success('Role has been deleted!');
        return back();
    }
}

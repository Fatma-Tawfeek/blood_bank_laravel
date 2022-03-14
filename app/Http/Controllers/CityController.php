<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = City::paginate(20);
        return view('cities.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $records = Governorate::pluck('name', 'id');

        return view('cities.create', compact('records'));
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
            'governorate_id' => 'required'
        ];
        $messages = [
            'name.required' => 'Name is required',
            'governorate_id.required' => 'Governorate is required'

        ];

        $this->validate($request, $rules, $messages);

        $record = City::create($request->all());

        flash()->success('City has been added Successfully!');

        return redirect(route('cities.index'));
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
        $record = City::findOrFail($id);
        $records = Governorate::pluck('name', 'id');
        return view('cities.edit', compact('record', 'records'));
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
            'governorate_id' => 'required'
        ];
        $messages = [
            'name.required' => 'Name is required',
            'governorate_id.required' => 'Governorate is required'

        ];

        $this->validate($request, $rules, $messages);

        $record = City::findOrfail($id);
        $record->update($request->all());
        flash()->success('City has been updated Successfully!');
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
        $record = City::findOrFail($id);
        $record->delete();
        flash()->success('City has been deleted!');
        return back();
    }
}

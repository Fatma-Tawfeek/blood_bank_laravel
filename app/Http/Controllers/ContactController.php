<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = Contact::where([
            [function ($query) use ($request) {
                if (($request->has('from')) || ($request->has('to'))) {
                    $query->where('created_at', '>=', $request->from)
                    ->where('created_at', '<=', $request->to)
                    ->get();
                }
            }]
        ])
        ->orderBy("id", "desc")
        ->paginate(20);
        return view('contacts.index', compact('records'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Contact::findOrFail($id);
        $record->delete();
        flash()->success('Contact has been deleted!');
        return back();
    }
}

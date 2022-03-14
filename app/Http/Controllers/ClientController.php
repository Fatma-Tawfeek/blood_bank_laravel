<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Client;
use App\Models\BloodType;
use App\Models\Governorate;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $records = Client::where([
            [function ($query) use ($request) {
                if (($keyword = $request->keyword)) {
                    $query->orWhere('name', 'LIKE', '%'. $keyword . '%')
                    ->orWhere('email', 'LIKE', '%'. $keyword . '%')
                    ->orWhere('phone', 'LIKE', '%'. $keyword . '%')
                    ->get();
                }
            }]
        ])->
        where([
            [function ($query) use ($request) {
                if (($request->has('blood_type'))) {
                $query->where('blood_type_id', $request->blood_type)->get();
                }
            }]
        ])
        ->where([
            [function ($query) use ($request) {
            if (($request->has('governorate'))) {
                $cities = City::where('governorate_id', $request->governorate)->pluck('id');
                $query->where('city_id', $cities)->get();
                }
            }]
        ])
        ->orderBy("id", "desc")
        ->paginate(20);

        $oldValue = $request->keyword;

        return view('clients.index',compact('records', 'oldValue'));
    }

    public function show($id)
    {
        $record = Client::findOrFail($id);
        return view('clients.show',compact('record'));
    }


    public function updateStatus($id, $status_code) {
        try {
            $update_client = Client::whereId($id)->update([
                'status' => $status_code
            ]);

            if($update_client) {
                flash()->success('Client Status has been updated successfully!');
                return back();
            }
            flash()->error('Failed to update client status');
            return back();

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        $record = Client::findOrFail($id);
        $record->delete();
        flash()->success('Client has been deleted!');
        return back();
    }
}

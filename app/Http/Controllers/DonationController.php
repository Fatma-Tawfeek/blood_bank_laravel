<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\BloodType;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\DonationRequest;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $records = DonationRequest::where([
            [function ($query) use ($request) {
                if (($keyword = $request->keyword)) {
                    $query->orWhere('patient_name', 'LIKE', '%'. $keyword . '%')
                    ->orWhere('patient_phone', 'LIKE', '%'. $keyword . '%')
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

        return view('donation.index',compact('records' ,'oldValue'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = DonationRequest::findOrFail($id);
        return view('donation.show',compact('record'));
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = DonationRequest::findOrFail($id);
        $record->delete();
        flash()->success('Donation Request has been deleted!');
        return back();
    }
}

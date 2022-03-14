<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Post;
use App\Models\Token;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Category;
use App\Models\BloodType;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Models\DonationRequest;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function governorates() {
        $governorates = Governorate::all();
        return responseJson(1, 'success', $governorates);
    }

    public function cities(Request $request) {
        $cities = City::where(function($query) use($request){
            if ($request->has('governorate_id')){
                $query->where('governorate_id', $request->governorate_id);
            }
        })->get();
        return responseJson(1, 'success', $cities);
    }

    public function bloodTypes() {
        $bloodTypes = BloodType::all();
        return responseJson(1, 'success', $bloodTypes);
    }

    public function posts() {
        $posts = Post::with('category')->paginate(20);
        return responseJson(1, 'success', $posts);
    }

    public function post(Request $request) {
        $post = Post::find($request->id);
        return responseJson(1, 'success', $post);
    }

    public function postFavourite(Request $request) {
        $rules = [
            'post_id' =>'required|exists:posts,id',
        ];
        $validator = validator()->make($request->all(),$rules);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $toggle = $request->user()->posts()->toggle($request->post_id);
        return responseJson(1, 'Success', $toggle);
    }

    public function myFavourites(Request $request) {
        $posts = $request->user()->posts()->latest()->paginate(20);
        return responseJson(0, 'Loaded...', $posts);
    }


    public function categories() {
        $categories = Category::all();
        return responseJson(1, 'success', $categories);
    }

    public function settings() {
        $settings = Setting::first();
        return responseJson(1, 'success', $settings);
    }

    public function contact(Request $request) {
        $validator = validator()->make($request->all(), [
            'subject' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }
        $contact = Contact::create($request->all());

        return responseJson(1, 'تم الارسال بنجاح', [
            'contact' => $contact
        ]);
    }

    public function donationRequestCreate(Request $request){
       $rules = [
            'patient_name' => 'required',
            'patient_age' => 'required:digits',
            'blood_type_id' => 'required',
            'bags_number' => 'required:digits',
            'hospital_address' => 'required',
            'city_id' => 'required|exists:cities,id',
            'patient_phone' => 'required|digits:11'
        ];

        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        // create donation request
        $donationRequest = $request->user()->requests()->create($request->all());

        // find clients suitable for this donation request
        $clientsIds = $donationRequest->city->governorate
        ->clients()->whereHas('bloodTypes', function($q) use ($request){
            $q->where('blood_types.id', $request->blood_type_id);
        })->pluck('clients.id')->toArray();

        $send = "";
        if(count($clientsIds)){
            // create a notification on database
            $notification = $donationRequest->notifications()->create([
                'title' => 'يوجد حالة قريبة منك',
                'content' => ($donationRequest->bloodType)->name .'محتاج متبرع لفصيلة',
            ]);

            // attach clients to this notification
            $notification->clients()->attach($clientsIds);

            //get tokens for FCM (Push notification using Firebase cloud)
            $tokens = Token::whereIn('client_id', $clientsIds)->where('token', '!=', null)->pluck('token')->toArray();

            if (count($tokens)) {


                $title = $request->title;
                $body = $request->body;
                $data = [
                    'donation_request_id' => $donationRequest->id
                ];
                $send = notifyByFirebase($title, $body, $tokens, $data);
                //info("firebase result: " . $send);
            }
        }
        return responseJson(1, 'تم الاضافة بنجاح', compact('donationRequest'));
    }

    public function donationRequests(Request $request) {
        $donationRequests = DonationRequest::with(['bloodType', 'city.governorate'])->paginate(20);
        return responseJson(1, 'success', $donationRequests);
    }

    public function donationRequest(Request $request) {
        $donationRequest = DonationRequest::find($request->id);
        return responseJson(1, 'success', $donationRequest);
    }
}

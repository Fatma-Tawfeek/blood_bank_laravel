<?php

namespace App\Http\Controllers\Front;

use App\Models\City;
use App\Models\Post;
use App\Models\Client;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\DonationRequest;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function home(Request $request) {

        $posts = Post::take(6)->get();

        $donations = DonationRequest::where([
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

        return view('front.home', compact('posts', 'donations'));
    }

    public function toggleFavourite(Request $request) {
        $toggle = auth('client-web')->user()->posts()->toggle($request->post_id);
        return responseJson(1, 'success');
    }

    public function donationRequests(Request $request) {
        $donations = DonationRequest::where([
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

        return view('front.donations', compact('donations'));
    }

    public function donationRequest($id) {
        $donation = DonationRequest::findOrFail($id);
        return view('front.donation', compact('donation'));
    }

    public function post($id) {
        $posts = Post::take(6)->get();
        $post = Post::findOrFail($id);
        return view('front.post', compact('post', 'posts'));
    }

    public function contact() {

        return view('front.contact');
    }

    public function contactSend(Request $request) {

        $rules = [
            'subject' => 'required',
            'message' => 'required'
        ];

        $messages = [
            'subject.required' => 'يرجي ادخال العنوان',
            'message.required' => 'يرجى ادخال الرسالة'
        ];

        $this->validate($request, $rules, $messages);

        $contact = Contact::create([
            'subject' => $request->subject,
            'message' => $request->message,
            'client_id' => $request->id
        ]);

        flash()->success('تم الارسال بنجاح.');

        return back();
    }

    public function about() {
        return view('front.about');
    }

}

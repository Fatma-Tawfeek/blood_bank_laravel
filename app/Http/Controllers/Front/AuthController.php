<?php

namespace App\Http\Controllers\front;

use App\Models\Client;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('front.register');
    }

    public function registerSave(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|unique:clients',
            'city_id' => 'required',
            'phone' => 'required',
            'last_donation_date' => 'required',
            'd_o_b' => 'required',
            'blood_type_id' => 'required',
            'password' => 'required|confirmed'
        ];
        $messages = [
            'name.required' => 'يرجي ادخال الاسم',
            'email.required' => 'يرجى ادخال البريد الالكتروني',
            'email.unique' => 'البريد الالكتروني مسجل بالفعل',
            'city_id.required' => 'يرجي اختيار مدينة',
            'phone.required' => 'يرجي ادخال الهاتف',
            'd_o_b.required' => 'يرجي ادخال اخر تاريخ الميلاد',
            'last_donation_date.required' => 'يرجي ادخال اخر تاريخ تبرع',
            'blood_type_id.required' => 'يرجي اخال فصلة الدم',
            'password.required' => 'يرجي ادخال كلمة السر'
        ];

        $this->validate($request, $rules, $messages);

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);

       // $client->save();

        $client->governorates()->attach($client->city->governorate_id);

        $client->bloodTypes()->attach($request->blood_type_id);

        flash()->success('تم التسجيل بنجاح.');

        return back();
    }

    public function login() {
        return view('front.login');
    }

    public function loginCheck(Request $request) {
        $rules = [
            'phone' => 'required',
            'password' => 'required'
        ];
        $messages = [
            'phone.required' => 'يرجي ادخال الهاتف',
            'password.required' => 'يرجي ادخال كلمة السر'
        ];

        $this->validate($request, $rules, $messages);

        $client = Client::where('phone', $request->phone)->first();
        if ($client) {
            if(Hash::check($request->password, $client->password)){
                Auth::guard('client-web')->attempt($request->only('phone','password'));
                return redirect(route('home'));
            }

        }else {
            flash()->error('يرجي التأكد من صحة البيانات.');
            return back();
        }
    }

    public function logout() {
        auth('client-web')->logout();
        return back();
    }
}

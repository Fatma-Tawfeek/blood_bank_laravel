<?php

namespace App\Http\Controllers\Api;

use App\Models\Token;
use App\Models\Client;
use App\Models\BloodType;
use App\Mail\ResetPassword;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validator = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:clients',
            'city_id' => 'required',
            'phone' => 'required',
            'last_donation_date' => 'required',
            'blood_type_id' => 'required',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = Str::random(60);

        $client->save();

        $client->governorates()->attach($client->city->governorate_id);

        $client->bloodTypes()->attach($request->blood_type_id);

        return responseJson(1, 'تم الاضافة بنجاح', [
            'api_token' => $client->api_token,
            'client' => $client
        ]);
    }

    public function login(Request $request) {
        $validator = validator()->make($request->all(), [
            'phone' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::where('phone', $request->phone)->first();
        if ($client) {
            if(Hash::check($request->password, $client->password)){
                return responseJson(1, 'تم تسجيل الدخول', [
                    'api_token' => $client->api_token,
                    'client' => $client
                ]);
            }

        }else {
            return responseJson(0, 'بيانات الدخول غيرصحيحة');

        }
    }

    public function reset(Request $request) {

        $validation = validator()->make($request->all(), [
            'phone' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $user = Client::where('phone', $request->phone)->first();
        if ($user) {
        $code = rand(1111,9999);
        $update = $user->update(['pin_code' => $code]);
            if ($update){
                Mail::to($user->email)
                    ->send(new ResetPassword($user));

                    return responseJson(1, 'برجاء فحص بريدك الالكتروني', [
                        'pin_code_for_test' => $code
                    ]);
                }
                else{
                    return responseJson(0, 'حدث خطأ , حاول أخري');
                }
            }
            else{
                return responseJson(0, 'لا يوجد أي حساب مرتبط بهذا الهاتف');
            }

        }

        public function password (Request $request) {
            $validation = validator()->make($request->all(), [
                'pin_code' => 'required',
                'password' => 'required|confirmed',
            ]);

            if ($validation->fails()) {
                $data = $validation->errors();
                return responseJson(0, $validation->errors()->first(), $data);
            }

            $user = Client::where('pin_code', $request->pin_code)->where('pin_code', '!=', 0)->first();
            if ($user) {

                $user->password = bcrypt($request->password);
                $user->pin_code = null;

                if ($user->save()) {
                    return responseJson(1, 'تم تغيير كلمة المرور بنجاح');
                }
                else{
                    return responseJson(0, 'حدث خطأ ، حاول مرة اخرى');
                }
           }else{
               return responseJson(0, 'هذا الكود غير صالح');
           }
    }

    public function profile(Request $request) {

        $validation = validator()->make($request->all(), [
            'password' => 'confirmed',
            'email' => Rule::unique('clients')->ignore($request->user()->id),
            'phone' => Rule::unique('clients')->ignore($request->user()->id),
        ]);

        if($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        $loginUser = $request->user();

        $loginUser->update($request->all());

        if ($request->has('password')) {
            $loginUser->password = bcrypt($request->password);
        }

        $loginUser->save();

        if ($request->has('governorate_id')) {
            $loginUser->governorates()->detach($loginUser->city->governorate_id);
            $loginUser->governorates()->attach($request->governorate_id);
        }

        if ($request->has('blood_type_id')) {
            $loginUser->bloodTypes()->detach($loginUser->bloodType->blood_type_id);
            $loginUser->bloodTypes()->attach($request->blood_type_id);
        }

        $data = [
            'user' => $request->user()->fresh()->load('governorates','bloodTypes')
        ];
        return responseJson(1, 'تم تحديث البيانات', $data);
    }

    public function getNotificationSettings(Request $request)
    {
        return responseJson(1, 'اعدادات الاشعارات', [
            'governorates' => $request->user()->governorates()->pluck('governorate_id')->toArray(),
            'blood_types' => $request->user()->bloodTypes()->pluck('blood_type_id')->toArray()
        ]);
    }

    public function notificationSettings(Request $request)
    {
        // validateion [governorates - blood_types]
        $rules = [
            'governorates' => 'exists:governorates,id',
            'blood_types' => 'exists:blood_types,id',
        ];

        $validator = validator()->make($request->all(),$rules);
        if ($validator->fails()) {
            return responseJson(0,$validator->errors()->first(),$validator->errors());
        }

        if ($request->has('governorates')) {
            $request->user()->governorates()->sync($request->governorates);
        }

        if ($request->has('blood_types')) {
            $request->user()->bloodtypes()->sync($request->blood_types);
        }

        $data = [
            'governorates' => $request->user()->governorates()->pluck('governorate_id')->toArray(),

            'blood_types' => $request->user()->bloodtypes()->pluck('blood_type_id')->toArray(),
        ];

        // return
         return responseJson(1, 'تم تحديث البيانات', $data);
    }

    public function registerToken(Request $request) {
        $validation = validator()->make($request->all(), [
            'token' => 'required',
            'platform' =>'required|in:android,ios'
        ]);

        if($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0, $validation->errors()->first(), $data);
        }

        Token::where('token', $request->token)->delete();
        $request->user()->tokens()->create($request->all());
        return responseJson(1, 'تم التسجيل بنجاح');
    }

    public function removeToken(Request $request)
    {
        $validation = validator()->make($request->all(), [
            'token' => 'required',
        ]);

        if ($validation->fails()) {
            $data = $validation->errors();
            return responseJson(0,$validation->errors()->first(),$data);
        }

        Token::where('token',$request->token)->delete();

        return responseJson(1,'تم  الحذف بنجاح بنجاح');
    }
}

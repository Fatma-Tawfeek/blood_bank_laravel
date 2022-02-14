<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Post;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function posts() {
        $posts = Post::with('category')->paginate(20);
        return responseJson(1, 'success', $posts);
    }

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
}

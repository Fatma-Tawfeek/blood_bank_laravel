<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $record = (object)[
            'email' => 'kkkkkkk',
            'phone' => '123456789',
            'fb_link' => 'kkkkkkkkkk',
            'tw_link' => 'kkkkkkkkkk',
            'insta_link' => 'kkkkkkkkkk',
            'yt_link' => 'kkkkkkkkkk',
            'about_app' => 'kkkkkkkkkk'
        ];

        return view('settings.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $record = (object)[
            'email' => 'kkkkkkk',
            'phone' => '123456789',
            'fb_link' => 'kkkkkkkkkk',
            'tw_link' => 'kkkkkkkkkk',
            'insta_link' => 'kkkkkkkkkk',
            'yt_link' => 'kkkkkkkkkk',
            'about_app' => 'kkkkkkkkkk'
        ];
        $record->update($request->all());
        flash()->success('Settings have been updated Successfully!');
        return back();
    }

}

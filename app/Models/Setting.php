<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('notifications_settings_text', 'about_app', 'phone', 'email', 'fb_link', 'insta_link', 'tw_link', 'yt_link');

}
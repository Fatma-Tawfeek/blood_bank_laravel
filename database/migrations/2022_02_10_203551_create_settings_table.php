<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('notifications_settings_text')->nullable();
			$table->text('about_app')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->nullable();
			$table->string('fb_link')->nullable();
			$table->string('insta_link')->nullable();
			$table->string('tw_link')->nullable();
			$table->string('yt_link')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}

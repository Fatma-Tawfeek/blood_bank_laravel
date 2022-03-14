<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('client_id')->unsigned()->onDelete('cascade');
			$table->string('subject');
			$table->text('message');
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}

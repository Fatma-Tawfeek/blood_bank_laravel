<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('phone');
			$table->string('password');
			$table->date('d_o_b');
			$table->date('last_donation_date');
			$table->string('pin_code')->nullable();
			$table->integer('blood_type_id')->unsigned()->onDelete('cascade');
			$table->integer('city_id')->unsigned()->onDelete('cascade');
            $table->integer('status')->default(1);
            $table->string('api_token', 60)->unique()->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}

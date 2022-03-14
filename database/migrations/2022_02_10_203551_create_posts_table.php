<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {

	public function up()
	{
		Schema::create('posts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('title');
			$table->text('content');
			$table->string('image');
			$table->integer('category_id')->unsigned()->onDelete('cascade');
		});
	}

	public function down()
	{
		Schema::drop('posts');
	}
}

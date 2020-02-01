<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactsTable extends Migration {

	public function up()
	{
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('email', 255);
			$table->string('phone', 25);
			$table->text('message');
			$table->integer('client_id');
			$table->enum('type', array('complaint', 'suggest', 'Inquire'));
		});
	}

	public function down()
	{
		Schema::drop('contacts');
	}
}

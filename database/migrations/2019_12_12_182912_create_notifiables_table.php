<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotifiablesTable extends Migration {

	public function up()
	{
		Schema::create('notifiables', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('notification_id');
			$table->integer('notifiable_id');
			$table->string('notifiable_type');
		});
	}

	public function down()
	{
		Schema::drop('notifiables');
	}
}
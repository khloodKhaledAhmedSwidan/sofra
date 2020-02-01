<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('special_order')->nullable();
			$table->integer('restaurant_id');
			$table->integer('client_id');
			$table->decimal('cost')->nullable();
			$table->decimal('net')->nullable();
			$table->decimal('total')->nullable();
			$table->decimal('commission')->nullable();
			$table->enum('state', array('pending', 'accepted', 'rejected', 'delivered', 'declined'));
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}

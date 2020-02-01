<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name', 255);
			$table->string('email', 255);
			$table->string('phone', 11);
			$table->integer('region_id');
			$table->string('password', 255);
			$table->integer('minimum');
			$table->integer('delivery_charge');
			$table->string('pin_code')->nullable();
            $table->integer('is_active')->default(0);
            $table->string('api_token', 60)->unique()->nullable();
			$table->enum('availability', array('1', '0'));
			$table->string('photo');
			$table->time('processing_time');
			$table->string('whatsapp');
			$table->decimal('payment_value');
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('photo')->nullable();
			$table->string('name', 255);
			$table->text('description');
			$table->decimal('price');
			$table->decimal('price_on_offer');
			$table->integer('restaurant_id');
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}

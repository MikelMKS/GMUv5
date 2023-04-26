<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipousuariosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipousuarios', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('tipo', 50)->nullable();
		});

		DB::table('tipousuarios')->insert([
			['tipo' => 'Admin']
			,['tipo' => 'Usuario']
		]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipousuarios');
	}

}

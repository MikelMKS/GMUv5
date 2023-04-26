<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipopagosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipopagos', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('tipo')->nullable();
		});

		DB::table('tipopagos')->insert([
			['tipo' => 'Mes']
			,['tipo' => 'Visita']
			,['tipo' => 'Semana']
			,['tipo' => 'Herbalife']
			,['tipo' => 'Pago']
		]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipopagos');
	}

}

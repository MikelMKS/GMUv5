<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoalertasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipoalertas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('nombre')->nullable();
			$table->string('icono')->nullable();
			$table->string('texto')->nullable();
		});

		DB::table('tipoalertas')->insert([
			['nombre' => 'CUMPLEAÑOS','icono' => 'ri-cake-2-line text-success','texto' => '¡Hoy es el cumpleaños de pesosdata clientes!']
			,['nombre' => 'FIN MES','icono' => '','texto' => '']
			,['nombre' => 'FIN SEMANA','icono' => '','texto' => '']
		]);
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipoalertas');
	}

}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlertasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alertas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('idTipo')->nullable()->index('alerta_tipo');
			$table->integer('visto')->nullable()->comment('0=no,1=si');
			$table->integer('idUsuario')->nullable()->index('usuario_alerta');
			$table->date('fecReg')->nullable();
			$table->string('dato')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alertas');
	}

}

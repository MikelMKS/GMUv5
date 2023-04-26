<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPagosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pagos', function(Blueprint $table)
		{
			$table->foreign('idCliente', 'clientePago')->references('id')->on('clientes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idRegistro', 'quienRegistro')->references('id')->on('usuarios')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idTipoPago', 'tipoPago')->references('id')->on('tipopagos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('idReferencia', 'tipoReferencias')->references('id')->on('tipopagos')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pagos', function(Blueprint $table)
		{
			$table->dropForeign('clientePago');
			$table->dropForeign('quienRegistro');
			$table->dropForeign('tipoPago');
			$table->dropForeign('tipoReferencias');
		});
	}

}

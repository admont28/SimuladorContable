<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntentoTallerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('IntentoTaller', function (Blueprint $table) {
            $table->increments('inta_id');
            $table->integer('inta_cantidad');
            $table->integer('usua_id')->unsigned();
            $table->foreign('usua_id')->references('id')->on('Users');
            $table->integer('tall_id')->unsigned();
            $table->foreign('tall_id')->references('tall_id')->on('Taller');
            $table->timestamp('inta_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('inta_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('IntentoTaller');
    }
}

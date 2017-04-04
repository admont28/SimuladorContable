<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePucTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Puc', function (Blueprint $table) {
            $table->increments('puc_id');
            $table->string('puc_codigo', 45);
            $table->string('puc_nombre', 100);
            $table->integer('curs_id')->unsigned();
            $table->foreign('curs_id')->references('curs_id')->on('Curso');
            $table->timestamp('puc_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('puc_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Puc');
    }
}

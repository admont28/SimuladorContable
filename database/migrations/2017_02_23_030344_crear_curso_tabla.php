<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearCursoTabla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Curso', function (Blueprint $table) {
            $table->increments('curs_id');
            $table->string('curs_nombre', 100);
            $table->text('curs_introduccion', 500);
            $table->timestamp('curs_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('curs_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePucComercialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PucComercial', function (Blueprint $table) {
            $table->increments('puco_id');
            $table->string('puco_codigo', 45);
            $table->string('puco_nombre', 100);
            $table->timestamp('puco_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('puco_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PucComercial');
    }
}

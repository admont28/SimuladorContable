<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTallerKardexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TallerKardex', function (Blueprint $table) {
            $table->increments('taka_id');
            $table->integer('tall_id')->unsigned();
            $table->foreign('tall_id')->references('tall_id')->on('Taller');
            $table->unique('tall_id');
            $table->timestamp('taka_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('taka_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TallerKardex');
    }
}

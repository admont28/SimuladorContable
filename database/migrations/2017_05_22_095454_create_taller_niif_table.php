<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTallerNiifTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('TallerNiif', function (Blueprint $table) {
            $table->increments('tani_id');
            $table->integer('tall_id')->unsigned();
            $table->foreign('tall_id')->references('tall_id')->on('Taller');
            $table->unique('tall_id');
            $table->string('tani_nombreempresa',100);
            $table->string('tani_periodo',100);
            $table->timestamp('tani_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('tani_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TallerNiif');
    }
}

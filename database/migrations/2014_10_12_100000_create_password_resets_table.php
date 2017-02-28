<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RestablecerContrasena', function (Blueprint $table) {
            $table->string('reco_correo')->index();
            $table->string('reco_token')->index();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('reco_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('reco_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RestablecerContrasena');
    }
}

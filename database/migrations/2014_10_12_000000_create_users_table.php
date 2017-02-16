<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Usuario', function (Blueprint $table) {
            $table->increments('usua_id');
            $table->string('usua_nombre');
            $table->string('usua_correo')->unique();
            $table->string('usua_contrasena');
            $table->enum('usua_rol', ['estudiante', 'profesor'])->default('estudiante');
            $table->rememberToken();
            $table->timestamp('usua_fechacreacion')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('usua_fechamodificacion')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Usuario');
    }
}

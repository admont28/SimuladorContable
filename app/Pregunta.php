<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
        /**
         * El nombre de la tabla asociada al modelo.
         *
         * @var string
         */
        protected $table = 'Pregunta';

        /**
         * El nombre de la llave primaria de la tabla.
         * Se modifica debido a que no es el nombre por defecto: id.
         *
         * @var string
         */
        protected $primaryKey = 'preg_id';

        /**
         * El nombre del campo equivalente a CREATE_AT en la base de datos.
         * Se modifica debido a que no es el nombre por defecto: create_at.
         *
         * @var string
         */
        const CREATED_AT = 'preg_fechacreacion';

        /**
         * El nombre del campo equivalente a UPDATED_AT en la base de datos.
         * Se modifica debido a que no es el nombre por defecto: update_at.
         *
         * @var string
         */
        const UPDATED_AT = 'preg_fechamodificacion';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'preg_id', 'preg_texto', 'preg_tipo','preg_porcentaje','tall_id'
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [

        ];

        /**
         * Obtener los talleres para la pregunta
         */
        public function taller()
        {
            return $this->hasMany('App\Taller','tall_id');
        }
}

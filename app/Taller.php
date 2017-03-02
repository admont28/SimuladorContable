<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    /    /**
         * El nombre de la tabla asociada al modelo.
         *
         * @var string
         */
        protected $table = 'Taller';

        /**
         * El nombre de la llave primaria de la tabla.
         * Se modifica debido a que no es el nombre por defecto: id.
         *
         * @var string
         */
        protected $primaryKey = 'tall_id';

        /**
         * El nombre del campo equivalente a CREATE_AT en la base de datos.
         * Se modifica debido a que no es el nombre por defecto: create_at.
         *
         * @var string
         */
        const CREATED_AT = 'tall_fechacreacion';

        /**
         * El nombre del campo equivalente a UPDATED_AT en la base de datos.
         * Se modifica debido a que no es el nombre por defecto: update_at.
         *
         * @var string
         */
        const UPDATED_AT = 'tall_fechamodificacion';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = [
            'tall_id', 'tall_nombre', 'tall_tipo','tall_tiempo','curs_id'
        ];

        /**
         * The attributes that should be hidden for arrays.
         *
         * @var array
         */
        protected $hidden = [

        ];

        /**
         * Obtener los temas para el curso
         */
        public function temas()
        {
            return $this->hasMany('App\Curso','curs_id');
        }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaArchivo extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'RespuestaArchivo';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'rear_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'rear_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'rear_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rear_id','rear_rutaarchivo','rear_nombre'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Obtener el taller de la pregunta que se esta calificando
     */
    public function Respuesta()
    {
        // Se pasa el modelo con el que está relacionado, seguido de la llave foranea de la tabla Curso en la tabla Taller
        return $this->hasMany('App\Respuesta','resp_id');
    }
}

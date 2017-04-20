<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respuesta extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'Respuesta';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'resp_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'resp_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'resp_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'resp_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Obtener el usuario
     */
    public function usuario()
    {
        //inverso de hasMany tecnicamente no es necesasario pero siempre usar la relación y la inversa. el inverso belongsTo trae un dato y el hasmany trae una coleccion.
        return $this->hasMany('App\User','usua_id');
    }
    /**
    * Obtener la pregunta del taller que se esta calificando
    */
   public function pregunta()
   {
       return $this->belongsTo('App\Pregunta','preg_id');
   }
    /**
     * Obtener el taller de la pregunta que se esta calificando
     */
    public function RespuestaMultipleUnica()
    {
        // Se pasa el modelo con el que está relacionado, seguido de la llave foranea de la tabla Curso en la tabla Taller
        return $this->belongsTo('App\RespuestaMultipleUnica','remu_id');
    }
    public function RespuestaAbierta()
    {
        // Se pasa el modelo con el que está relacionado, seguido de la llave foranea de la tabla Curso en la tabla Taller
        return $this->belongsTo('App\RespuestaMultipleUnica','remu_id');
    }
    public function RespuestaArchivo()
    {
        // Se pasa el modelo con el que está relacionado, seguido de la llave foranea de la tabla Curso en la tabla Taller
        return $this->belongsTo('App\RespuestaArchivo','rear_id');
    }




}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Auth;

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
     * Obtener el taller dueño de la pregunta
     */
    public function taller()
    {
        return $this->belongsTo('App\Taller','tall_id');
    }

    /**
     * Obtener las respuestas multiple unica
     */
    public function respuestasMultiplesUnicas()
    {
        // Se pasa el modelo con el que está relacionado, seguido de la llave foranea de la tabla Pregunta en la tabla RespuestaMultipleUnica
        return $this->hasMany('App\RespuestaMultipleUnica','preg_id');
    }

    public static function getPossibleEnumValues(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM Pregunta WHERE Field = "preg_tipo"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }

    public function tieneRespuestaMultiple(){
        $cantidadRespuestaCorrecta = RespuestaMultipleUnica::where('preg_id', $this->preg_id)->where('remu_correcta',true)->count();
        if ($cantidadRespuestaCorrecta>1) {
            return true;
        }
        return false;
    }

    public function cantidadRespuestasCorrectas()
    {
        return RespuestaMultipleUnica::where('preg_id', $this->preg_id)->where('remu_correcta',true)->count();
    }

    public function obtenerRespuestasCorrectas()
    {
        return RespuestaMultipleUnica::where('preg_id', $this->preg_id)->where('remu_correcta',true)->get();
    }

    public function calificaciones()
    {
        //inverso de hasMany tecnicamente no es necesasario pero siempre usar la relación y la inversa. el inverso belongsTo trae un dato y el hasmany trae una coleccion.
        return $this->hasMany('App\Calificacion','preg_id');
    }

    public function respuestas()
    {
        //inverso de hasMany tecnicamente no es necesasario pero siempre usar la relación y la inversa. el inverso belongsTo trae un dato y el hasmany trae una coleccion.
        return $this->hasMany('App\Respuesta','preg_id');
    }
    public function obtenerRespuestaUsuario()
    {
        return Respuesta::where('usua_id',Auth::user()->usua_id)->where('preg_id',$this->preg_id)->get();
    }

}

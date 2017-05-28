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
        'resp_id', 'usua_id', 'preg_id', 'remu_id', 'rear_id', 'resp_abierta'
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
        return $this->belongsTo('App\User','usua_id');
    }

    /**
    * Obtener la pregunta del taller que se respondio.
    */
    public function pregunta()
    {
       return $this->belongsTo('App\Pregunta','preg_id');
    }

    /**
     * Obtener la respuesta de una pregunta multiple-unica.
     */
    public function respuestaMultipleUnica()
    {
        // Se pasa el modelo con el que está relacionado, seguido de la llave foranea de la tabla respuestaMultipleUnica en la tabla respuesta
        return $this->belongsTo('App\RespuestaMultipleUnica','remu_id');
    }

    public function respuestaArchivo()
    {
        // Se pasa el modelo con el que está relacionado, seguido de la llave foranea de la tabla Curso en la tabla Taller
        return $this->belongsTo('App\RespuestaArchivo','rear_id');
    }

    public function respuestaUsuarioPregunta($usua_id, $preg_id){
        return Respuesta::where('usua_id', $usuario)->where('preg_id', $preg_id)->get();
    }

    /**
     * conversion de la consulta  SELECT DISTINCT u.usua_nombre FROM Respuesta r, Pregunta p, Taller t, Usuario u WHERE u.usua_id = r.usua_id and r.preg_id = p.preg_id and p.tall_id = 1
     * @param  [type] $tall_id [description]
     * @return [type]          [description]
     */
    public function usuariosPorTaller($curs_id, $tall_id)
    {
        return DB::table('Respuesta')
                    ->join('Usuario','Respuesta.usua_id','=','Usuario.usua_id')
                    ->join('Pregunta','Respuesta.preg_id','=','Pregunta.preg_id')
                    ->join('Calificacion','Respuesta.preg_id','=','Calificacion.preg_id')
                    ->join('Taller','Calificacion.tall_id','=','Taller.tall_id')
                    ->where('tall_id', $tall_id)
                    ->distinct()
                    ->get();
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Taller extends Model
{
    /**
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
        'tall_id', 'tall_nombre','tall_tipo','tall_tiempo','curs_id','tall_rutaarchivo','tall_nombrearchivo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Obtener las preguntas para el taller
     */
    public function preguntas()
    {
        return $this->hasMany('App\Pregunta','tall_id');
    }

    /**
     * Obtener el curso que es dueño del taller.
     */
    public function curso()
    {
        //inverso de hasMany tecnicamente no es necesasario pero siempre usar la relación y la inversa. el inverso belongsTo trae un dato y el hasmany trae una coleccion.
        return $this->belongsTo('App\Curso', 'curs_id');
    }

    /**
     * Obtener las tarifas para el taller.
     */
    public function tarifas()
    {
        // Foranea de Taller en la tabla tarifa.
        return $this->hasMany('App\Tarifa', 'tall_id');
    }

    /**
     * Obtener el taller de asiento contable asociado al taller actual.
     */
    public function tallerAsientoContable()
    {
        return $this->hasOne('App\TallerAsientoContable', 'tall_id');
    }

    /**
     * Obtener el taller de nomina asociado al taller actual.
     */
    public function tallerNomina()
    {
        return $this->hasOne('App\TallerNomina', 'tall_id');
    }

    /**
     * Obtener el taller de kardex asociado al taller actual.
     */
    public function tallerKardex()
    {
        return $this->hasOne('App\tallerKardex', 'tall_id');
    }

    public static function getPossibleEnumValues(){
        $type = DB::select(DB::raw('SHOW COLUMNS FROM Taller WHERE Field = "tall_tipo"'))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $values = array();
        foreach(explode(',', $matches[1]) as $value){
            $values[] = trim($value, "'");
        }
        return $values;
    }

    public function Calificaciones()
    {
        //inverso de hasMany tecnicamente no es necesasario pero siempre usar la relación y la inversa. el inverso belongsTo trae un dato y el hasmany trae una coleccion.
        return $this->hasMany('App\Calificacion','tall_id');
    }

    /**
     * Consulta en la base de datos quienes han respondido el taller seleccionado.
     *  conversion de la consulta  SELECT DISTINCT u.usua_nombre FROM Respuesta r, Pregunta p, Taller t, Usuario u WHERE u.usua_id = r.usua_id and r.preg_id = p.preg_id and p.tall_id = 1
     * @var [type]
     */
    public function usuariosPorTaller()
    {
        //$sql = 'SELECT DISTINCT u.usua_nombre FROM Respuesta r, Pregunta p, Taller t, Usuario u WHERE u.usua_id = r.usua_id and r.preg_id = p.preg_id and t.tall_id=';
        return DB::table('Users')
            ->select('Users.id','name', 'email')
            ->distinct()
            ->join('Respuesta','Users.id','=','Respuesta.usua_id')
            ->join('Pregunta','Respuesta.preg_id','=','Pregunta.preg_id')
            ->join('Taller','Pregunta.tall_id','=','Taller.tall_id')
            ->where('Taller.tall_id',$this->tall_id)
            ->get();
    }

}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'Usuario';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'usua_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'usua_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'usua_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usua_nombre', 'usua_correo', 'usua_contrasena','usua_rol'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'usua_contrasena', 'remember_token',
    ];

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->usua_contrasena;
    }

    // 2
    public function getEmailForPasswordReset() {
        return $this->usua_correo;
    }

    // 3
    public function getUserNameForPasswordReset(){
        return $this->usua_correo;
    }

    // 4
    protected $email = "usua_correo";

    public function calificaciones()
    {
        //inverso de hasMany tecnicamente no es necesasario pero siempre usar la relación y la inversa. el inverso belongsTo trae un dato y el hasmany trae una coleccion.
        return $this->hasMany('App\Calificacion','usua_id');
    }

    public function respuestas()
    {
        //inverso de hasMany tecnicamente no es necesasario pero siempre usar la relación y la inversa. el inverso belongsTo trae un dato y el hasmany trae una coleccion.
        return $this->hasMany('App\Respuesta','usua_id');
    }

    /**
     * método para consultar las respuestas que hizo el estudiante en un determinado taller
     * SELECT DISTINCT `pregunta`.`preg_texto`, `calificacion`.`cali_ponderado`, `usuario`.`usua_nombre`
     * FROM `pregunta` JOIN `respuesta` ON `pregunta`.`preg_id` = `respuesta`.`preg_id` JOIN `usuario` ON `respuesta`.`usua_id` = `usuario`.`usua_id`
     * JOIN `calificacion` ON `usuario`.`usua_id` = `calificacion`.`usua_id`
     * WHERE `usuario`.`usua_id`= 3
     *
     * SELECT DISTINCT pregunta.preg_texto, calificacion.cali_calificacion, calificacion.cali_ponderado
     * FROM respuesta r
     *  INNER JOIN pregunta ON pregunta.preg_id = r.preg_id
     *  LEFT OUTER JOIN calificacion ON calificacion.preg_id = pregunta.preg_id
     *  WHERE pregunta.tall_id = 1 AND r.usua_id = 3
     */
    public function respuestasTallerPorEstudiante($tall_id)
    {
        return DB::table('Respuesta')
        ->select('Pregunta.preg_id','preg_texto','preg_tipo','cali_calificacion','cali_ponderado')
        ->distinct()
        ->join('Pregunta','Pregunta.preg_id','=','Respuesta.preg_id')
        ->leftjoin('Calificacion','Calificacion.preg_id','=','Pregunta.preg_id')
        ->where('Pregunta.tall_id',$tall_id)
        ->where('Respuesta.usua_id',$this->usua_id)
        ->get();
        /*
            SELECT DISTINCT p.preg_texto, c.cali_calificacion, c.cali_ponderado FROM respuesta r, pregunta p, usuario u, calificacion c, taller t WHERE r.preg_id = p.preg_id and p.tall_id = t.tall_id and p.preg_id = c.preg_id and r.usua_id = u.usua_id and t.tall_id = 1 and u.usua_id = 3;
         */
    }
}

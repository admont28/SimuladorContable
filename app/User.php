<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    /**
     * método para consultar las respuestas que hizo el estudiante en un determinado taller
     * SELECT DISTINCT `pregunta`.`preg_texto`, `calificacion`.`cali_ponderado`, `usuario`.`usua_nombre`
     * FROM `pregunta` JOIN `respuesta` ON `pregunta`.`preg_id` = `respuesta`.`preg_id` JOIN `usuario` ON `respuesta`.`usua_id` = `usuario`.`usua_id`
     * JOIN `calificacion` ON `usuario`.`usua_id` = `calificacion`.`usua_id`
     * WHERE `usuario`.`usua_id`= 3
     */
    public function respuestasPorEstudiante()
    {
        return DB::table('Pregunta')
        ->join('Respuesta','Pregunta.preg_id','=','Respuesta.preg_id')
        ->join('Usuario','Respuesta.usua_id','=','Usuario.usua_id')
        ->join('Calificacion','Usuario.usua_id','=','Calificacion.usua_id')
        ->where('usua_id',$this->usua_id)
        ->get();
    }
}

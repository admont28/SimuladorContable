<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;

class Curso extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'Curso';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'curs_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'curs_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'curs_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'curs_id', 'curs_nombre', 'curs_introduccion'
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
    public function talleres()
    {
        // Se pasa el modelo con el que está relacionado, seguido de la llave foranea de la tabla Curso en la tabla Taller
        return $this->hasMany('App\Taller','curs_id');
    }

    public function materias()
    {
        return $this->hasMany('App\Materia','curs_id');
    }

    public function pucs()
    {
        return $this->hasMany('App\Puc','curs_id');
    }

    public function talleresDiagnosticoFinalizadosUsuario()
    {
        // SELECT Distinct t.tall_id
        // FROM Respuesta r, Pregunta p, Taller t
        // WHERE
        //  r.preg_id = p.preg_id
        //  AND p.tall_id = t.tall_id
        //  AND t.tall_tipo = 'diagnostico'
        //  AND r.usua_id = 2
        return DB::table('Respuesta')
                ->join('Pregunta', 'Respuesta.preg_id', '=', 'Pregunta.preg_id')
                ->join('Taller', 'Pregunta.tall_id', '=', 'Taller.tall_id')
                ->select('Taller.tall_id')
                ->distinct()
                ->where('Taller.tall_tipo','diagnostico')
                ->where('Respuesta.usua_id',Auth::user()->id)
                ->get();
    }

    public function talleresTeoricoFinalizadosUsuario()
    {
        // SELECT Distinct t.tall_id
        // FROM Respuesta r, Pregunta p, Taller t
        // WHERE
        //  r.preg_id = p.preg_id
        //  AND p.tall_id = t.tall_id
        //  AND t.tall_tipo = 'teorico'
        //  AND r.usua_id = 2
        return DB::table('Respuesta')
                ->join('Pregunta', 'Respuesta.preg_id', '=', 'Pregunta.preg_id')
                ->join('Taller', 'Pregunta.tall_id', '=', 'Taller.tall_id')
                ->select('Taller.tall_id')
                ->distinct()
                ->where('Taller.tall_tipo','teorico')
                ->where('Respuesta.usua_id',Auth::user()->id)
                ->get();
    }

    public function talleresPracticoFinalizadosUsuario()
    {
        // SELECT Distinct t.tall_id
        // FROM Respuesta r, Pregunta p, Taller t
        // WHERE
        //  r.preg_id = p.preg_id
        //  AND p.tall_id = t.tall_id
        //  AND t.tall_tipo = 'practico'
        //  AND r.usua_id = 2
        return DB::table('Respuesta')
                ->join('Pregunta', 'Respuesta.preg_id', '=', 'Pregunta.preg_id')
                ->join('Taller', 'Pregunta.tall_id', '=', 'Taller.tall_id')
                ->select('Taller.tall_id')
                ->distinct()
                ->where('Taller.tall_tipo','practico')
                ->where('Respuesta.usua_id',Auth::user()->id)
                ->get();
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puc extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'Puc';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'puc_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'puc_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'puc_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'puc_id', 'puc_codigo', 'puc_nombre', 'curs_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Obtener el curso que es dueño del taller.
     */
    public function curso()
    {
        // La foranea de Curso en la tabla Puc relacionada con la tabla Curso.
        return $this->belongsTo('App\Curso', 'curs_id');
    }

    public function respuestasTallerAsientoContable()
    {
        return $this->hasMany('App\RespuestaTallerAsientoContable', 'puc_id');
    }
    
}

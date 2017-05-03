<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaTallerAsientoContable extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'RespuestaTallerAsientoContable';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'rtac_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'rtac_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'rtac_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rtac_id', 'taac_id', 'usua_id', 'puc_id', 'rtac_valordebito', 'rtac_valorcredito', 'rtac_fila'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Obtener la pregunta dueña de la respuesta multiple unica
     */
    public function puc()
    {
        return $this->belongsTo('App\Puc','puc_id');
    }

    public function usuario()
    {
        return $this->belongsTo('App\User','usua_id');
    }

}

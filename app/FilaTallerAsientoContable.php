<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilaTallerAsientoContable extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'FilaTallerAsientoContable';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'ftac_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'ftac_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'ftac_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ftac_id', 'rtac_id', 'puc_id', 'ftac_valordebito', 'ftac_valorcredito','ftac_fila'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Obtener la respuesta taller de asientos contables dueño de la fila.
     */
    public function respuestaTallerAsientoContable()
    {
        return $this->belongsTo('App\RespuestaTallerAsientoContable','rtac_id');
    }

    public function puc()
    {
        return $this->belongsTo('App\Puc','puc_id');
    }
    
}

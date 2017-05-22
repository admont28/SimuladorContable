<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class TallerAsientoContable extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'TallerAsientoContable';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'taac_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'taac_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'taac_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'taac_id','tall_id', 'taac_cantidadtablas'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Obtener las respuestas del taller de asientos contables
     */
    public function respuestasTallerAsientosContables()
    {
        return $this->hasMany('App\RespuestaTallerAsientoContable','taac_id');
    }

    /**
     * Obtener el taller que es dueño del taller de asiento contable.
     */
    public function taller()
    {
        return $this->belongsTo('App\Taller', 'tall_id');
    }

    public function respuestasTallerAsientoContableUsuarioAutenticado($numeroTabla = null)
    {
        if(is_null($numeroTabla)){
            return RespuestaTallerAsientoContable::where('usua_id', Auth::user()->id)->where('taac_id', $this->taac_id)->get();
        }
        return RespuestaTallerAsientoContable::where('usua_id', Auth::user()->id)->where('taac_id', $this->taac_id)->where('rtac_numerotabla', $numeroTabla)->get();
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class TallerKardex extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'TallerKardex';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'taka_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'taka_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'taka_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'taka_id', 'tall_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Obtener las respuestas del taller de nomina
     */
    public function respuestasTallerKardex()
    {
        return $this->hasMany('App\RespuestaTallerKardex','taka_id');
    }

    /**
     * Obtener el taller que es dueño del taller de kardex
     */
    public function taller()
    {
        return $this->belongsTo('App\Taller', 'tall_id');
    }

    public function respuestaTallerKardexUsuarioAutenticado()
    {
        return RespuestaTallerKardex::where('usua_id', Auth::user()->usua_id)->where('taka_id', $this->taka_id)->get()->first();
    }
}

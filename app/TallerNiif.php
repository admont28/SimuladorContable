<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TallerNiif extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'TallerNiif';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'tani_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'tani_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'tani_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tani_id', 'tall_id', 'tani_nombreempresa', 'tani_periodo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Obtener las respuestas del taller niif.
     */
    public function respuestasTallerNiif()
    {
        return $this->hasMany('App\RespuestaTallerNiif','tani_id');
    }

    /**
     * Obtener el taller que es dueño del taller niif.
     */
    public function taller()
    {
        return $this->belongsTo('App\Taller', 'tall_id');
    }

    /**
     * Obtener la RespuestaTallerNiif del usuario autenticado.
     * @return RespuestaTallerNiif Retorna el primer objeto de tipo RespuestaTallerNiif si el usuario tiene una, de lo contrario retorna null.
     */
    public function respuestaTallerNiifUsuarioAutenticado()
    {
        return RespuestaTallerNiif::where('usua_id', Auth::user()->id)->where('tani_id', $this->tani_id)->get()->first();
    }
}

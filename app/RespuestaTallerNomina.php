<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaTallerNomina extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'RespuestaTallerNomina';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'retn_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'retn_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'retn_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'retn_id', 'tano_id', 'usua_id', 'rear_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function usuario()
    {
        return $this->belongsTo('App\User','usua_id');
    }

    public function tallerNomina()
    {
        return $this->belongsTo('App\TallerNomina','tano_id');
    }

    public function respuestaArchivo()
    {
        return $this->belongsTo('App\RespuestaArchivo','rear_id');
    }

    public function filasTallerNomina()
    {
        return $this->hasMany('App\FilaTallerNomina', 'retn_id');
    }

    public function calcularTotalColumna($columna = "")
    {
        return FilaTallerNomina::where('retn_id', $this->retn_id)->sum($columna);
    }
    
}

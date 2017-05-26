<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaTallerNiif extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'RespuestaTallerNiif';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'rtni_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'rtni_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'rtni_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rtni_id', 'tani_id', 'usua_id', 'rear_id'
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

    public function tallerNiif()
    {
        return $this->belongsTo('App\TallerNiif','tani_id');
    }

    public function balancesPruebas()
    {
        return $this->hasMany('App\BalancePrueba', 'rtni_id');
    }

    public function estadoResultado()
    {
        return $this->hasOne('App\EstadoResultado', 'rtni_id');
    }

    public function estadoSituacionFinanciera()
    {
        return $this->hasOne('App\EstadoSituacionFinanciera', 'rtni_id');
    }

    public function respuestaArchivo()
    {
        return $this->belongsTo('App\RespuestaArchivo', 'rear_id');
    }

    public function calcularTotalEnBalancePruebaColumna($columna = "")
    {
        return BalancePrueba::where('rtni_id', $this->rtni_id)->sum($columna);
    }
}

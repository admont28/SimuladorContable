<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TallerNomina extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'TallerNomina';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'tano_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'tano_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'tano_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tano_id', 'tano_deduccionuno', 'tano_deducciondos', 'tano_deducciontres', 'tall_id'
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
    public function respuestasTallerNomina()
    {
        return $this->hasMany('App\RespuestaTallerNomina','tano_id');
    }

    /**
     * Obtener el taller que es dueño del taller de asiento contable.
     */
    public function taller()
    {
        return $this->belongsTo('App\Taller', 'tall_id');
    }

    public function cantidadDeducciones()
    {
        $cantidad = 0;
        if(isset($this->tano_deduccionuno) && $this->tano_deduccionuno != "")
            $cantidad++;
        if(isset($this->tano_deducciondos) && $this->tano_deducciondos != "")
            $cantidad++;
        if(isset($this->tano_deducciontres) && $this->tano_deducciontres != "")
            $cantidad++;
        return $cantidad;
    }
}

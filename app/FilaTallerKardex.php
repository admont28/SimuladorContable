<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilaTallerKardex extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'FilaTallerKardex';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'fitk_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'fitk_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'fitk_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fitk_id',
        'retk_id',
        'fitk_dia',
        'fitk_mes',
        'fitk_ano',
        'fitk_detalle',
        'fitk_valorunitario',
        'fitk_entradascantidad',
        'fitk_entradasvalor',
        'fitk_salidascantidad',
        'fitk_salidasvalor',
        'fitk_saldocantidad',
        'fitk_saldovalor',
        'fitk_promedio',
        'fitk_fila'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Obtiene la respuesta taller kardex que es dueña del registro.
     * 
     * @return RespuestaTallerKardex Retorna el modelo RespuestaTallerKardex o null.
     */
    public function respuestaTaller()
    {
        return $this->belongsTo('App\RespuestaTallerKardex','retk_id');
    }
}

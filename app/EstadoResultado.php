<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoResultado extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'EstadoResultado';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'esre_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'esre_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'esre_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'esre_id', 'rtni_id', 'esre_ingresosoperacionales', 'esre_totalingresosoperacionales', 'esre_costoventa', 'esre_utilidadbruta','esre_gastospersonal', 'esre_resultadoexplotacion', 'esre_ingresosfinancieros', 'esre_gastosfinancieros', 'esre_utilidadantesimpuestos', 'esre_impuestosobreganancias', 'esre_utilidadliquida', 'esre_reservalegal', 'esre_utilidadnetaejercicio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Obtener la respuesta taller niif
     */
    public function respuestaTallerNiif()
    {
        return $this->belongsTo('App\RespuestaTallerNiif','rtni_id');
    }
    
}

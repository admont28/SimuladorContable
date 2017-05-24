<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstadoSituacionFinanciera extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'EstadoSituacionFinanciera';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'essf_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'essf_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'essf_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'essf_id', 'rtni_id', 'essf_efectivoequivalentes', 'essf_deudores', 'essf_anticipoimpuesto', 'essf_inventario','essf_activocorriente', 'essf_construccionesedificaciones', 'essf_equiposoficina', 'essf_equipocomputacioncomunicacion', 'essf_flotaequipotransporte', 'essf_activonocorriente', 'essf_totalactivos', 'essf_proveedores', 'essf_retencionfuente', 'essf_retencionaportesnomina', 'essf_acreedoresvarios', 'essf_ivagenerado', 'essf_obligacioneslaborales', 'essf_pasivocorriente',
        'essf_obligacionesfinancieras', 'essf_pasivonocorriente', 'essf_totalpasivos', 'essf_aportessociales', 'essf_utilidadejercicio', 'essf_reservasobligatorias', 'essf_totalpatrimonio', 'essf_totalpasivopatrimonio'
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

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
        'retn_id', 'tano_id', 'usua_id', 'retn_nombresyapellidos', 'retn_documento','retn_diastrabajados','retn_salario','retn_salariobasico','retn_horasextrasyrecargos','retn_comisiones','retn_bonificaciones','retn_totaldevengado','retn_auxdetransporte','retn_totaldevengadoconauxiliodetransporte','retn_salud','retn_pension','retn_deduccionuno','retn_deducciondos','retn_deducciontres','retn_totaldeducciones','retn_netoapagar','retn_horaextradiurnacantidad','retn_horaextradiurnavalor','retn_horaextranocturnacantidad','retn_horaextranocturnavalor',
        'retn_recargonocturnocantidad','retn_recargonocturnovalor','retn_horafestivadiurnacantidad','retn_horafestivadiurnavalor','retn_horafestivanocturnacantidad','retn_horafestivanocturnavalor','retn_horaextrafestivadiurnacantidad','retn_horaextrafestivadiurnavalor','retn_horaextradestivanocturnacantidad','retn_horaextrafestivanocturnavalor','retn_valortotaldehorasextras','retn_rutaarchivo','retn_fila'
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
}

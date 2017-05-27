<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FilaTallerNomina extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'FilaTallerNomina';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'fitn_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'fitn_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'fitn_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fitn_id',
        'retn_id',
        'fitn_nombresyapellidos',
        'fitn_documento',
        'fitn_diastrabajados',
        'fitn_salario',
        'fitn_salariobasico',
        'fitn_horasextrasyrecargos',
        'fitn_comisiones',
        'fitn_bonificaciones',
        'fitn_totaldevengado',
        'fitn_auxdetransporte',
        'fitn_totaldevengadoconauxiliodetransporte',
        'fitn_salud',
        'fitn_pension',
        'fitn_deduccionuno',
        'fitn_deducciondos',
        'fitn_deducciontres',
        'fitn_totaldeducciones',
        'fitn_netoapagar',
        'fitn_horaextradiurnacantidad',
        'fitn_horaextradiurnavalor',
        'fitn_horaextranocturnacantidad',
        'fitn_horaextranocturnavalor',
        'fitn_recargonocturnocantidad',
        'fitn_recargonocturnovalor',
        'fitn_horafestivadiurnacantidad',
        'fitn_horafestivadiurnavalor',
        'fitn_horafestivanocturnacantidad',
        'fitn_horafestivanocturnavalor',
        'fitn_horaextrafestivadiurnacantidad',
        'fitn_horaextrafestivadiurnavalor',
        'fitn_horaextrafestivanocturnacantidad',
        'fitn_horaextrafestivanocturnavalor',
        'fitn_valortotaldehorasextras',
        'fitn_fila'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function respuestaTallerNomina()
    {
        return $this->belongsTo('App\RespuestaTallerNomina','retn_id');
    }
    
}

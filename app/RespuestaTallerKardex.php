<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RespuestaTallerKardex extends Model
{
    /**
     * El nombre de la tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'RespuestaTallerKardex';

    /**
     * El nombre de la llave primaria de la tabla.
     * Se modifica debido a que no es el nombre por defecto: id.
     *
     * @var string
     */
    protected $primaryKey = 'retk_id';

    /**
     * El nombre del campo equivalente a CREATE_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: create_at.
     *
     * @var string
     */
    const CREATED_AT = 'retk_fechacreacion';

    /**
     * El nombre del campo equivalente a UPDATED_AT en la base de datos.
     * Se modifica debido a que no es el nombre por defecto: update_at.
     *
     * @var string
     */
    const UPDATED_AT = 'retk_fechamodificacion';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'retk_id', 'taka_id', 'usua_id', 'rear_id', 'retk_articulo', 'retk_direccion', 'retk_proveedores'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * Obtiene el usuario que dió respuesta al taller de kardex.
     *
     * @return User Retorna el modelo User o null.
     */
    public function usuario()
    {
        return $this->belongsTo('App\User','usua_id');
    }

    /**
     * Obtiene el taller kardex de la respuesta.
     *
     * @return TallerKardex Retorna el modelo TallerKardex o null.
     */
    public function tallerKardex()
    {
        return $this->belongsTo('App\TallerKardex','taka_id');
    }

    /**
     * Obtiene la respuesta de tipo archivo cargada por el usuario.
     *
     * @return RespuestaArchivo Retorna el modelo RespuestaArchivo o null.
     */
    public function respuestaArchivo()
    {
        return $this->belongsTo('App\RespuestaArchivo','rear_id');
    }

    /**
     * Obtiene las filas que respondió un usuario del taller karde
     *
     * @return Collection Retorna una Colección de FilaTallerKardex o vacío.
     */
    public function filasTallerKardex()
    {
        return $this->hasMany('App\FilaTallerKardex', 'retk_id');
    }
    
}

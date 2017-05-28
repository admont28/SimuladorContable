<div class="row">
    <div class="form-horizontal">
        <div class="form-group">
            <label for="articulo_taller_kardex" class="col-lg-2 control-label">Artículo:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" placeholder="Ingrese el artículo" name="articulo_taller_kardex" value="@if( $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado() !== null) {{ $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->retk_articulo }}  @endif"/>
            </div>
        </div>
        <div class="form-group">
            <label for="direccion_taller_kardex" class="col-lg-2 control-label">Dirección:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" placeholder="Ingrese la dirección" name="direccion_taller_kardex" value="@if( $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado() !== null) {{ $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->retk_direccion }} @endif"/>
            </div>
        </div>
        <div class="form-group">
            <label for="proveedores_taller_kardex" class="col-lg-2 control-label">Proveedores:</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" placeholder="Ingrese los proveedores" name="proveedores_taller_kardex" value="@if( $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado() !== null) {{ $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->retk_proveedores }} @endif"/>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover taller-kardex">
            <thead>
                <tr>
                    <td colspan="13" class="text-center"><strong>PROMEDIO PONDERADO</strong></td>
                </tr>
                <tr>
                    <td colspan="3" class="text-center vcenter"><strong>FECHA</strong></td>
                    <td rowspan="2" class="text-center vcenter"><strong>DETALLE</strong></td>
                    <td rowspan="2" class="text-center vcenter"><strong>VALOR UNITARIO</strong></td>
                    <td colspan="2" class="text-center vcenter"><strong>ENTRADAS</strong></td>
                    <td colspan="2" class="text-center vcenter"><strong>SALIDAS</strong></td>
                    <td colspan="2" class="text-center vcenter"><strong>SALDO</strong></td>
                    <td rowspan="2" class="text-center vcenter"><strong>PROMEDIO</strong></td>
                    <td rowspan="2" class="text-center vcenter"><strong>OPCIÓN</strong></td>
                </tr>
                <tr>
                    <td class="text-center vcenter"><strong>DÍA</strong></td>
                    <td class="text-center vcenter"><strong>MES</strong></td>
                    <td class="text-center vcenter"><strong>AÑO</strong></td>
                    <td class="text-center vcenter"><strong>CANTIDAD</strong></td>
                    <td class="text-center vcenter"><strong>VALOR</strong></td>
                    <td class="text-center vcenter"><strong>CANTIDAD</strong></td>
                    <td class="text-center vcenter"><strong>VALOR</strong></td>
                    <td class="text-center vcenter"><strong>CANTIDAD</strong></td>
                    <td class="text-center vcenter"><strong>VALOR</strong></td>
                </tr>
            </thead>
            <tbody>
                @if ($tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado() === null)
                    @for ($i = 0; $i < 2; $i++)
                        <tr>
                            <td class="text-center vcenter td-dia numero " contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                            <td class="text-center vcenter td-mes numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                            <td class="text-center vcenter td-ano numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                            <td class="text-center vcenter td-detalle" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar."></td>
                            <td class="text-center vcenter td-valor-unitario actualizar-entradas-y-salidas" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">$ 0</td>
                            <td class="text-center vcenter td-entradas-cantidad numero actualizar-entradas-y-salidas" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                            <td class="text-center vcenter td-entradas-valor">$ 0</td>
                            <td class="text-center vcenter td-salidas-cantidad numero actualizar-entradas-y-salidas" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">0</td>
                            <td class="text-center vcenter td-salidas-valor">$ 0</td>
                            <td class="text-center vcenter td-saldo-cantidad numero">0</td>
                            <td class="text-center vcenter td-saldo-valor">$ 0</td>
                            <td class="text-center vcenter td-promedio">$ 0</td>
                            <td class="text-center vcenter td-opcion"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                        </tr>
                    @endfor
                @else
                    @foreach ($tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->filasTallerKardex as $fitk)
                        <tr>
                            <td class="text-center vcenter td-dia numero " contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_dia }}</td>
                            <td class="text-center vcenter td-mes numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_mes }}</td>
                            <td class="text-center vcenter td-ano numero" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_ano }}</td>
                            <td class="text-center vcenter td-detalle" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_detalle }}</td>
                            <td class="text-center vcenter td-valor-unitario actualizar-entradas-y-salidas" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_valorunitario }}</td>
                            <td class="text-center vcenter td-entradas-cantidad numero actualizar-entradas-y-salidas" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_entradascantidad }}</td>
                            <td class="text-center vcenter td-entradas-valor">{{ $fitk->fitk_entradasvalor }}</td>
                            <td class="text-center vcenter td-salidas-cantidad numero actualizar-entradas-y-salidas" contenteditable="true" data-toggle="tooltip" title="Presione clic para editar.">{{ $fitk->fitk_salidascantidad }}</td>
                            <td class="text-center vcenter td-salidas-valor">{{ $fitk->fitk_salidasvalor }}</td>
                            <td class="text-center vcenter td-saldo-cantidad numero">{{ $fitk->fitk_saldocantidad }}</td>
                            <td class="text-center vcenter td-saldo-valor">{{ $fitk->fitk_saldovalor }}</td>
                            <td class="text-center vcenter td-promedio">{{ $fitk->fitk_promedio }}</td>
                            <td class="text-center vcenter td-opcion"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12 text-center">
        <div class="form-group">
            <label for="archivo_taller_kardex" class="col-lg-2 control-label">Archivo</label>
            <div class="col-lg-10">
                <input type="file" class="form-control" placeholder="ruta del archivo" name="archivo_taller_kardex">
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        @if (isset($tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->rear_id))
            <div class="alert alert-info" role="alert">
                <p>Usted ya ha cargado el siguiente archivo: <strong><a class="alert-link" target="_blank" href="{{ $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->respuestaArchivo->rear_rutaarchivo }}">{{ $tallerPractico->tallerKardex->respuestaTallerKardexUsuarioAutenticado()->respuestaArchivo->rear_nombre }}</a>.</strong> Si selecciona otro archivo, el archivo existente será reemplazado.</p>
            </div>
        @endif
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12 text-center">
        <button class="btn btn-default adicionar-fila-kardex">Adicionar fila</button>
        <button class="btn btn-primary solucionar-taller-kardex" data-ruta="{{ route('estudiante.curso.taller.solucionar.kardex.post', ['curs_id' => $curso->curs_id, 'tall_id' => $tallerPractico->tall_id]) }}">Guardar taller</button>
    </div>
</div>

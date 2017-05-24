@extends('profesor.template.main')

@section('title-head', 'Respuesta de taller de kardex')

@section('title')
    {!! 'Taller de kardex - Respuesta del usuario: <strong>'.$usuario->name.'</strong>' !!}
@endsection

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Respuesta del usuario - Carga de archivo</h3>
                </div>
                <div class="panel-body">
                    @if (isset($respuestaTallerKardex->respuestaArchivo))
                        <a href="{{ $respuestaTallerKardex->respuestaArchivo->rear_rutaarchivo }}">{{ $respuestaTallerKardex->respuestaArchivo->rear_nombre }}</a>
                    @else
                        <p>EL usuario no cargó algún archivo.</p>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Respuesta del usuario - Tabla de kardex</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="articulo_taller_kardex" class="col-lg-2 control-label"><strong>Artículo:</strong></label>
                                <div class="col-lg-10">
                                    <p class="form-control-static">{{ $respuestaTallerKardex->retk_articulo or 'SIN ARTÍCULO'}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="direccion_taller_kardex" class="col-lg-2 control-label"><strong>Dirección:</strong></label>
                                <div class="col-lg-10">
                                    <p class="form-control-static">{{ $respuestaTallerKardex->retk_direccion or 'SIN DIRECCIÓN'}}</p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="proveedores_taller_kardex" class="col-lg-2 control-label"><strong>Proveedores:</strong></label>
                                <div class="col-lg-10">
                                    <p class="form-control-static">{{ $respuestaTallerKardex->retk_proveedores or 'SIN PROVEEDORES'}}</p>
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
                                    @foreach ($respuestaTallerKardex->filasTallerKardex as $fitk)
                                        <tr>
                                            <td class="text-center vcenter td-dia numero ">{{ $fitk->fitk_dia }}</td>
                                            <td class="text-center vcenter td-mes numero">{{ $fitk->fitk_mes }}</td>
                                            <td class="text-center vcenter td-ano numero">{{ $fitk->fitk_ano }}</td>
                                            <td class="text-center vcenter td-detalle">{{ $fitk->fitk_detalle }}</td>
                                            <td class="text-center vcenter td-valor-unitario actualizar-entradas-y-salidas">{{ $fitk->fitk_valorunitario }}</td>
                                            <td class="text-center vcenter td-entradas-cantidad numero actualizar-entradas-y-salidas">{{ $fitk->fitk_entradascantidad }}</td>
                                            <td class="text-center vcenter td-entradas-valor">{{ $fitk->fitk_entradasvalor }}</td>
                                            <td class="text-center vcenter td-salidas-cantidad numero actualizar-entradas-y-salidas">{{ $fitk->fitk_salidascantidad }}</td>
                                            <td class="text-center vcenter td-salidas-valor">{{ $fitk->fitk_salidasvalor }}</td>
                                            <td class="text-center vcenter td-saldo-cantidad numero">{{ $fitk->fitk_saldocantidad }}</td>
                                            <td class="text-center vcenter td-saldo-valor">{{ $fitk->fitk_saldovalor }}</td>
                                            <td class="text-center vcenter td-promedio">{{ $fitk->fitk_promedio }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a href="{{ route('profesor.curso.taller.ver', ['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id]) }}" class="btn btn-default">Regresar</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".taller-kardex > tbody > tr > td").each(function(index, el) {
                if ($(el).hasClass('td-detalle') || $(el).hasClass('td-opcion')) {
                    return; //this is equivalent of 'continue' for jQuery loop
                }else if($(el).hasClass('numero')){
                    $(el).text(numeral($(el).text()).format('0'));
                }
                else{
                    $(el).text(numeral($(el).text()).format('$0,0'));
                }
            });
        });
    </script>
@endpush

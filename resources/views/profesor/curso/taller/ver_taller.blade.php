@extends('profesor.template.main')

@section('title-head', 'Ver taller')

@section('title')
    {!! 'Taller: <strong>'.$taller->tall_nombre.'</strong>' !!}
@endsection

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <div class="col-lg-2">
            <strong>Nombre del taller:</strong>
        </div>
        <div class="col-lg-10 text-justify">
            {{ $taller->tall_nombre }}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2">
            <strong>Tipo:</strong>
        </div>
        <div class="col-lg-10 text-justify">
            {{ $taller->tall_tipo }}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2">
            <strong>Fecha máxima de envío:</strong>
        </div>
        <div class="col-lg-10 text-justify">
            <div class='input-group date ' >
                {{ $taller->tall_tiempo }}
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2">
            <strong>Archivo asociado:</strong>
        </div>
        <div class="col-lg-10 text-justify">
            <a href="{{ $taller->tall_rutaarchivo }}"> {{ $taller->tall_nombrearchivo }} </a>
        </div>
        <br>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a href="{{ route('profesor.curso.ver',['curs_id'=>$taller->curs_id]) }}"  class="btn btn-default">Regresar</a>
            <a href="{{ route('profesor.curso.taller.editar',['curs_id'=>$taller->curs_id,'tall_id' => $taller->tall_id]) }}"  class="btn btn-primary">Editar taller</a>
        </div>
    </div>
    @if ($taller->tall_tipo == 'practico')
        <div class="row">
            <div class="page-header">
                <h1>Sub-tipo del taller</h1>
            </div>
        </div>
        @if(isset($taller->tallerAsientoContable))
            <div class="row">
                <div class="col-lg-3">
                    <strong>Sub-tipo:</strong>
                </div>
                <div class="col-lg-9 text-justify">
                    <span class="label label-info">Taller Asientos Contables</span>
                </div>
            </div>
            <br>
        @elseif (isset($taller->tallerNomina))
            <div class="row">
                <div class="col-lg-3">
                    <strong>Sub-tipo:</strong>
                </div>
                <div class="col-lg-9 text-justify">
                    <span class="label label-success">Taller de Nómina</span>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <strong>¿Deducción uno?:</strong>
                </div>
                <div class="col-lg-9 text-justify">
                    {{ $taller->tallerNomina->tano_deduccionuno != "" ? $taller->tallerNomina->tano_deduccionuno : 'SIN DEDUCCIÓN' }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <strong>¿Deducción dos?:</strong>
                </div>
                <div class="col-lg-9 text-justify">
                    {{ $taller->tallerNomina->tano_deducciondos != "" ? $taller->tallerNomina->tano_deducciondos : 'SIN DEDUCCIÓN' }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <strong>¿Deducción tres?:</strong>
                </div>
                <div class="col-lg-9 text-justify">
                    {{ $taller->tallerNomina->tano_deducciontres != "" ? $taller->tallerNomina->tano_deducciontres : 'SIN DEDUCCIÓN' }}
                </div>
            </div>
        @elseif (isset($taller->tallerKardex))
            <div class="row">
                <div class="col-lg-3">
                    <strong>Sub-tipo:</strong>
                </div>
                <div class="col-lg-9 text-justify">
                    <span class="label label-warning">Taller de Kardex</span>
                </div>
            </div>
            <br>
        @else
            <div class="row">
                <div class="bs-callout bs-callout-danger">
                    <h4><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ¡Atención Profesor!</h4>
                    <p class="lead">Al Marcar el taller actual con uno de los tipos de taller abajo ilustrados, usted no podrá deshacer esta acción.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <form class="visible-lg-inline-block visible-sm-inline-block visible-md-inline-block visible-xs-inline-block" action="{{ route('profesor.curso.taller.crear.tallerasientocontable.post', ['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id]) }}" method="post" id="form-tallerasientocontable">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-info" id="btn-taller-asiento-contable">Taller para asientos contables</button>
                    </form>
                    <a href="{{ route('profesor.curso.taller.crear.tallernomina', ['curs_id'=>$curso->curs_id,'tall_id' => $taller->tall_id]) }}" class="btn btn-success">Taller de nómina</a>
                    <form class="visible-lg-inline-block visible-sm-inline-block visible-md-inline-block visible-xs-inline-block" action="{{ route('profesor.curso.taller.crear.tallerkardex.post', ['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id]) }}" method="post" id="form-tallerkardex">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-warning" id="btn-taller-kardex">Taller de kardex</button>
                    </form>
                    <a href="#" class="btn btn-default">Taller de estados financieros NIF</a>
                </div>
            </div>
        @endif
        <div class="row">
            <div class="page-header">
                <h1>Tarifas</h1>
            </div>
        </div>
        @include('profesor.curso.taller.tarifa.index')
    @else
        <div class="row">
            <div class="page-header">
                <h1>Preguntas del taller</h1>
            </div>
        </div>
        @include('profesor.curso.taller.pregunta.index')
        <div class="row">
            <div class="page-header">
                <h1>Usuarios que han respondido el taller</h1>
            </div>
        </div>
        @include('profesor.curso.taller.usuarios_solucionado_taller')
@endif

@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            /**
             * Función para pedir confirmación del usuario antes de eliminar un elemento de la tabla.
             */
            $(document).on('click', '#btn-taller-asiento-contable', function(event) {
                event.preventDefault();
                var form = $('#form-tallerasientocontable');
                swal({
                    title: '¿Está seguro de esta acción?',
                    text: "Al marcar el taller con el sub-tipo: Taller Asientos Contables no podrá deshacer la acción. Por favor confirme.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, continuar',
                    cancelButtonText: 'No, cancelar'
                }).then(function (option) {
                    if(option === true){
                        form.submit();
                        return true;
                    }else{
                        return false;
                    }
                })
            });
            $(document).on('click', '#btn-taller-kardex', function(event) {
                event.preventDefault();
                var form = $('#form-tallerkardex');
                swal({
                    title: '¿Está seguro de esta acción?',
                    text: "Al marcar el taller con el sub-tipo: Taller Kardex no podrá deshacer la acción. Por favor confirme.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, continuar',
                    cancelButtonText: 'No, cancelar'
                }).then(function (option) {
                    if(option === true){
                        form.submit();
                        return true;
                    }else{
                        return false;
                    }
                })
            });
        });
    </script>
@endpush

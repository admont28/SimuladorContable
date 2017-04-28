@extends('profesor.template.main')

@section('title-head', 'Ver taller')

@section('title', 'Taller: <strong>'.$taller->tall_nombre.'</strong>')

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
        @if(isset($tallerAsientoContable))
            <div class="row">
                <div class="col-lg-3">
                    <strong>Sub-tipo:</strong>
                </div>
                <div class="col-lg-9 text-justify">
                    Taller Asientos Contables
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <strong>Cantidad de filas de la tabla para ser solucionado:</strong>
                </div>
                <div class="col-lg-9 text-justify">
                    {{ $tallerAsientoContable->taac_cantidadfilas }}
                </div>
            </div>
        @elseif (isset($tallerNomina))
            <div class="row">
                <div class="col-lg-3">
                    <strong>Sub-tipo:</strong>
                </div>
                <div class="col-lg-9 text-justify">
                    Taller de Nómina
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <strong>Cantidad de filas de la tabla:</strong>
                </div>
                <div class="col-lg-9 text-justify">
                    {{ $tallerNomina->tano_cantidadfilas }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <strong>¿Deducciones en prestamo?:</strong>
                </div>
                <div class="col-lg-9 text-justify">
                    {{ $tallerNomina->tano_deduccionuno }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <strong>¿Deducción dos?:</strong>
                </div>
                <div class="col-lg-9 text-justify">
                    {{ $tallerNomina->tano_deducciondos }}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3">
                    <strong>¿Deducción tres?:</strong>
                </div>
                <div class="col-lg-9 text-justify">
                    {{ $tallerNomina->tano_deducciontres }}
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-lg-12">
                    <p class="lead">Marcar el taller actual con uno de los siguientes tipos (Esta acción no se podrá deshacer):</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="{{ route('profesor.curso.taller.crear.tallerasientocontable', ['curs_id'=>$taller->curs_id,'tall_id' => $taller->tall_id]) }}" class="btn btn-info">Taller para asientos contables</a>
                    <a href="{{ route('profesor.curso.taller.crear.tallernomina', ['curs_id'=>$taller->curs_id,'tall_id' => $taller->tall_id]) }}" class="btn btn-success">Taller de nómina</a>
                    <a href="#" class="btn btn-warning">Taller de kardex</a>
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
        @include('profesor.curso.taller.pregunta.calificacion.ver_calificacion')
@endif

@endsection

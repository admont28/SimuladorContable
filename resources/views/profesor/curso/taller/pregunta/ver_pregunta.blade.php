@extends('profesor.template.main')

@section('title-head', 'Ver pregunta')

@section('title')
    {!! 'Pregunta: <strong>'.substr($pregunta->preg_texto,0,80).'...</strong>' !!}
@endsection

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <div class="col-lg-2">
            <strong>Texto de la pregunta:</strong>
        </div>
        <div class="col-lg-10 text-justify">
            {{ $pregunta->preg_texto }}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2">
            <strong>Tipo de pregunta:</strong>
        </div>
        <div class="col-lg-10 text-justify">
            {{ $pregunta->preg_tipo }}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2">
            <strong>Porcentaje de la pregunta:</strong>
        </div>
        <div class="col-lg-10 text-justify">
            <div class='input-group date ' >
                {{ $pregunta->preg_porcentaje*100 }}%
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a href="{{ route('profesor.curso.taller.ver',['curs_id'=>$curso->curs_id, 'tall_id' => $taller->tall_id]) }}"  class="btn btn-default">Regresar</a>
            <a href="{{ route('profesor.curso.taller.pregunta.editar',['curs_id'=>$curso->curs_id,'tall_id' => $taller->tall_id, 'preg_id' => $pregunta->preg_id]) }}"  class="btn btn-primary">Editar pregunta</a>
        </div>
    </div>
    @if ($pregunta->preg_tipo == 'unica-multiple')
        <div class="row">
            <div class="page-header">
                <h1>Respuestas de la pregunta</h1>
            </div>
        </div>
        @include('profesor.curso.taller.pregunta.respuesta.index')
    @endif
@endsection

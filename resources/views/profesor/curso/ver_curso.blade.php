@extends('profesor.template.main')

@section('title-head', 'Ver curso')

@section('title')
    {!! 'Curso: <strong>'.$curso->curs_nombre.'</strong>' !!}
@endsection

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <div class="col-lg-2">
            <strong>Nombre del curso:</strong>
        </div>
        <div class="col-lg-10 text-justify">
            {{ $curso->curs_nombre }}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2">
            <strong>Introducción del curso:</strong>
        </div>
        <div class="col-lg-10 text-justify">
            {{ $curso->curs_introduccion }}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a type="reset" class="btn btn-default" href="{{ route('profesor.curso') }}">Regresar</a>
            <a type="submit" class="btn btn-primary" href="{{ route('profesor.curso.editar', ['id' => $curso->curs_id]) }}">Editar curso</a>
        </div>
    </div>
    <div class="row">
        <div class="page-header">
            <h1>Materias</h1>
        </div>
    </div>
    @include('profesor.curso.materia.index')
    <div class="row">
        <div class="page-header">
            <h1>Talleres</h1>
        </div>
    </div>
    @include('profesor.curso.taller.index')
    <div class="row">
        <div class="page-header">
            <h1>PUC</h1>
        </div>
    </div>
    @include('profesor.curso.puc.index')
@endsection

@extends('profesor.template.main')

@section('title',' Curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <div class="col-lg-2">
            Nombre del curso:
        </div>
        <div class="col-lg-10">
            {{ $curso->curs_nombre }}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-2">
            Introducción del curso:
        </div>
        <div class="col-lg-10">
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

    @include('profesor.curso.materia.ver_materia')

@endsection

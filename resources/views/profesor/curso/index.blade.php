@extends('profesor.template.main')

@section('title', 'Sección de cursos')

@section('active','#profesor-curso')

@section('content')
<p>Bienvenido a la sección de cursos por favor escoja que desea hacer:</p>

<li><a href="{{ route('profesor.crearcurso') }}">Crear un curso</a></li>
<li><a href="{{ route('profesor.curso.ver') }}">Ver cursos disponibles</a></li>
<li><a href="{{ route('profesor.tema') }}">{{ trans('messages.tema') }}</a></li>

@include('profesor.template.partials.table', ['cabeceras' => $cabeceras, 'filas' => $cursos, 'nombres_atributos' => $nombres_atributos, 'opciones' => $opciones])

@endsection

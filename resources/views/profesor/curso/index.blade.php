@extends('profesor.template.main')

@section('title', 'Sección de cursos')

@section('content')
<p>Bienvenido a la sección de cursos por favor escoja que desea hacer:</p>

<li><a href="{{ route('profesor.crearcurso') }}">Crear un curso</a></li>
<li><a href="{{ route('profesor.vercursos') }}">Ver cursos disponibles</a></li>
<li><a href="{{ route('profesor.tema') }}">{{ trans('messages.tema') }}</a></li>



@endsection

@extends('profesor.template.main')

@section('title', 'Sección de cursos')

@section('content')
<p>Bienvenido a la sección de cursos por favor escoja que desea hacer:</p>

<li><a href="{{ route('profesor.creartaller') }}">Crear un curso</a></li>
<li><a href="{{ route('profesor.vertalleres') }}">Ver curso disponibles</a></li>



@endsection

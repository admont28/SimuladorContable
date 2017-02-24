@extends('profesor.template.main')

@section('title', 'Sección de temas')

@section('content')
<p>Bienvenido a la sección de temas por favor escoja que desea hacer:</p>

<li><a href="{{ route('profesor.creartema') }}">Crear un tema</a></li>
<li><a href="{{ route('profesor.vertemas') }}">Ver temas disponibles</a></li>




@endsection

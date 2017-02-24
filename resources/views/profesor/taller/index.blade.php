@extends('profesor.template.main')

@section('title', 'Sección de talleres')

@section('content')
<p>Bienvenido a la sección de talleres por favor escoja que desea hacer:</p>

<li><a href="{{ route('profesor.creartaller') }}">Crear un taller</a></li>
<li><a href="{{ route('profesor.vertalleres') }}">Ver talleres disponibles</a></li>



@endsection

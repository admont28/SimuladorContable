@extends('profesor.template.main')

@section('title', 'Sección de talleres')

@section('active','#profesor-taller')

@section('content')
<p>Bienvenido a la sección de talleres por favor escoja que desea hacer:</p>

<li><a href="{{ route('profesor.creartaller') }}">Crear un taller</a></li>
<li><a href="{{ route('profesor.vertalleres') }}">Ver talleres disponibles</a></li>


<div class="table-responsive">
    {!! $dataTable->table(['class' => 'table table-bordered table-condensed table-hover table-striped']) !!}
</div>

@endsection

@section('scripts')
{!! $dataTable->scripts() !!}
@endsection

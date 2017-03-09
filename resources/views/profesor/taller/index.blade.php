@extends('profesor.template.main')

@section('title', 'Sección de talleres')

@section('active','#profesor-taller')

@section('content')
<p>Bienvenido a la sección de talleres por favor escoja que desea hacer:</p>
<a href="{{ route('profesor.creartaller') }}" class="btn btn-primary" >Crear un taller</a>
<br>
<br>



<div  class="table-responsive" >
    {!! $dataTable->table(['class' => 'table table-bordered table-condensed table-hover table-striped']) !!}
</div>

@endsection

@section('scripts')

{!! $dataTable->scripts() !!}
@endsection

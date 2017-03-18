@extends('profesor.template.main')

@section('title', 'Sección de Preguntas')

@section('active','#profesor-taller')

@section('content')
<p>Bienvenido a la sección de preguntas por favor escoja que desea hacer:</p>
<a href="{{ route('profesor.curso.taller.pregunta') }}" class="btn btn-primary" >Crear una pregunta</a>
<br>
<br>



<div  class="table-responsive" >
    {!! $dataTable->table(['class' => 'table table-bordered table-condensed table-hover table-striped']) !!}
</div>

@endsection

@section('scripts')

{!! $dataTable->scripts() !!}
@endsection

@extends('profesor.template.main')

@section('title', 'Página principal del profesor')

@section('active','#profesor-index')

@section('content')
    <div class="col-md-12">
        <div class="col-md-5 text-center">
            <img src="{{ asset('images/mujer-senala.jpg') }}" alt="Mujer Señala" class="img-responsive">
        </div>
        <p class="lead">Hola profesor</p>
    </div>
@endsection

@extends('general.template.main')

@section('title', 'Página principal')

@section('content')
    <div class="col-md-12">
        <div class="col-md-5 text-center">
            <img src="{{ asset('images/mujer-senala.jpg') }}" alt="Mujer Señala" class="img-responsive">
        </div>
        <p>Hola visitante, estás en la página principal de la aplicación Simulador Contable</p>
    </div>
@endsection

@extends('estudiante.template.main')

@section('title', '¡Bienvenido estudiante!')

@section('active','#estudiante-index')

@section('content')
    <div class="col-md-12">
        <div class="col-md-5">
            <img src="{{ asset('images/mujer-senala.jpg') }}" alt="Mujer Señala" class="img-responsive">
        </div>
        <div class="col-md-7 text-justify">
            <ul class="lead">
                <li>Los temas a tratar en el laboratorio contable son: ejercicios de asientos contables, nómina, taller de kardex por el método ponderado y Estados Financieros bajo  NIIF.</li>
                <li>El estudiante tendrá la posibilidad de visualizar el PUC en una pestaña de la sección de talleres prácticos.</li>
                <li>Se Mostraran los talleres disponibles en forma de pestañas.</li>
            </ul>
        </div>
    </div>
@endsection

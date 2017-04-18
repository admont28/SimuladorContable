@extends('profesor.template.main')

@section('title-head', 'Ver calificacion')

@section('title', 'taller <strong>'.$taller->tall_id.'...</strong>')

@section('active','#profesor-curso')

@section('content')

    <div class="row">
        <div class="table-responsive">
            <p>{{$pregunta->preg_texto}}</p>
        </div>
    </div>

@endsection

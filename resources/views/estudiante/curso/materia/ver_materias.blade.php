@extends('estudiante.template.main')

@section('title-head', 'Ver materias de un curso')

@section('title',' Curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#estudiante-curso')

@section('content')
    <div class="row">
        <h2 class="text-center"><strong>MATERIAS</strong></h2>
    </div>
    <div class="row">
        <div id="accordion" class="panel-group">
            @foreach ($materias as $materia)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $materia->mate_id }}">{{ $materia->mate_nombre }}</a>
                        </h4>
                    </div>
                    <div id="collapse-{{ $materia->mate_id }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <h3><strong>Temas a Tratar</strong></h3>
                            <p>{{ $materia->mate_tema }}</p>
                            <br>
                            <h3><strong>Archivo Asociado</strong></h3>
                            <p><a href="{{ $materia->mate_rutaarchivo }}">{{ $materia->mate_nombrearchivo }}</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a type="reset" class="btn btn-default" href="{{ route('estudiante.curso.ver.introduccion', ['curs_id' => $curso->curs_id]) }}">Regresar</a>
            <a type="button" class="btn btn-primary" href="{{ route('estudiante.curso.ver.talleresdiagnostico',['curs_id'=> $curso->curs_id]) }}">Siguiente</a>
        </div>
    </div>
@endsection

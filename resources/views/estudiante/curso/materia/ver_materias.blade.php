@extends('estudiante.template.main')

@section('title-head', 'Ver curso')

@section('title',' Curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#estudiante-curso')

@section('content')

<h1>Materias:</h1>
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
                    <p><strong><h3>Temas a Tratar</h3></strong></p>
                    <p>{{ $materia->mate_tema }}</p>
                    <br>
                    <p><strong><h3>Archivo Asociado</h3></strong></p>
                    <p><a href="{{ $materia->mate_rutaarchivo }}">{{ $materia->mate_nombrearchivo }}</a></p>

                </div>
            </div>
        </div>


@endforeach
</div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a type="reset" class="btn btn-default" href="{{ route('estudiante.curso') }}">Regresar</a>
            <a type="button" class="btn btn-primary" href="{{ route('estudiante.curso.ver.talleres',['curs_id'=>$materia->curs_id]) }}">Siguiente</a>
        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">





    </script>
@endsection

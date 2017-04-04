@extends('estudiante.template.main')

@section('title-head', 'Ver curso')

@section('title',' Curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#estudiante-curso')

@section('content')

<h1>{{ $taller->tall_nombre }}</h1>
<div id="accordion" class="panel-group">
@foreach ($preguntas as $pregunta)



        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $taller->tall_id }}">{{ $taller->tall_nombre }}</a>
                </h4>
            </div>
            <div id="collapse-{{ $taller->tall_id }}" class="panel-collapse collapse">
                <div class="panel-body">
                    <p><strong><h3>Tipo de Taller</h3></strong></p>
                    <p>{{ $taller->tall_tipo }}</p>
                    <br>
                    <p><strong><h3>Fecha Máxima de Envío</h3></strong></p>
                    <p>{{ $taller->tall_tiempo }}</p>
                    <br>
                    <p><strong><h3>Archivo Asociado</h3></strong></p>
                    <p><a href="{{ $taller->tall_rutaarchivo }}">{{ $taller->tall_nombrearchivo }}</a></p>
                    <div class="text-center">
                        <a href="#" class="btn btn-primary">Resolver Taller</a>
                    </div>


                </div>
            </div>
        </div>


@endforeach
</div>
    <div class="row">
        <div class="col-lg-10">
            <a type="reset" class="btn btn-default" href="{{ route('estudiante.curso') }}">Regresar</a>

        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">





    </script>
@endsection

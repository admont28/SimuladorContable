@extends('estudiante.template.main')

@section('title-head', 'Ver curso')

@section('title',' Curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#estudiante-curso')

@section('content')

    <div id="accordion" class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">1.Materias</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse">
                <div class="panel-body">
                    @foreach ($materias as $mat)
                        <p>{{ $mat->mate_nombre }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">2.Temas a tratar</a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse in">
                <div class="panel-body">
                    @foreach ($materias as $materia)
                        <p>{{ $materia->mate_tema }}</p>
                    @endforeach

                </div>
            </div>
        </div>
        
    </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a type="reset" class="btn btn-default" href="{{ route('estudiante.curso') }}">Regresar</a>

        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">



    </script>
@endsection

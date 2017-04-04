@extends('estudiante.template.main')

@section('title-head', 'Ver curso')

@section('title',' Curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#estudiante-curso')

@section('content')
    <div class="col-md-12">
        <div class="col-md-5">
            <img src="{{ asset('images/mujer-senala.jpg') }}" alt="Mujer Señala" class="img-responsive">

        </div>
        <div class="col-md-7 text-justify">
            <h3 align="center"><strong>INTRODUCCIÓN</strong></h3>
            <p>{{ $curso->curs_introduccion }}</p>
        </div>

    </div>


    <div class="row">
        <div class="col-lg-12 text-center">
            <a type="reset" class="btn btn-default" href="{{ route('estudiante.curso') }}" >Regresar</a>
            <a type="button" class="btn btn-primary" href="{{ route('estudiante.curso.ver.materias',['curso'=>$curso,'materias'=>$materias]) }}">Siguiente</a>
        </div>

    </div>
@endsection

@section('scripts')
    <script type="text/javascript">



    </script>
@endsection

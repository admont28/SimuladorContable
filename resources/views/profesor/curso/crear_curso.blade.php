@extends('profesor.template.main')

@section('title-head', 'Crear curso')

@section('title', 'Crear curso')

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.crear.post') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="nombre_curso" class="col-lg-2 control-label">Nombre del curso:</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="nombre_curso" placeholder="Ingrese el nombre del curso" name="nombre_curso">
                </div>
            </div>
            <div class="form-group">
                <label for="introduccion_curso" class="col-lg-2 control-label">Introducción del curso:</label>
                <div class="col-lg-10">
                   <textarea class="form-control" rows="3" id="introduccion_curso" name="introduccion_curso" placeholder="Ingrese la introducción del curso"></textarea>
                   <span class="help-block">En este campo puede describir con exactitud todo lo relacionado con la descripción del curso.</span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a type="reset" class="btn btn-default" href="{{ route('profesor.curso') }}">Regresar</a>
                    <button type="submit" class="btn btn-primary">Crear Curso</button>
                </div>
            </div>
        </form>
    </div>
@endsection

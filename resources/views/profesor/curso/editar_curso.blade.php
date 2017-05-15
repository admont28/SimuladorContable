@extends('profesor.template.main')

@section('title-head', 'Editar curso')

@section('title', 'Editar curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#profesor-curso')

@section('content')
<form class="form-horizontal" action="{{ route('profesor.curso.put',['curs_id' => $curso->curs_id]) }}" method="post">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <div class="form-group {{ $errors->has('nombre_curso') ? ' has-error' : '' }}">
        <label for="nombre_curso" class="col-lg-2 control-label">Nombre del curso:</label>
        <div class="col-lg-10">
            <input type="text" class="form-control" id="nombre_curso" value="{{ $curso->curs_nombre }}" name="nombre_curso" placeholder="Ingrese el nombre del curso" autofocus="autofocus" required="required">
            @if ($errors->has('nombre_curso'))
                <span class="help-block">
                    <strong>{{ $errors->first('nombre_curso') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group {{ $errors->has('introduccion_curso') ? ' has-error' : '' }}">
        <label for="introduccion_curso" class="col-lg-2 control-label">Introducción del curso:</label>
        <div class="col-lg-10">
           <textarea class="form-control" rows="3" id="introduccion_curso" name="introduccion_curso" placeholder="Ingrese la introducción del curso" required="required">{{ $curso->curs_introduccion }}</textarea>
           @if ($errors->has('introduccion_curso'))
               <span class="help-block">
                   <strong>{{ $errors->first('introduccion_curso') }}</strong>
               </span>
           @endif
           <span class="help-block">En este campo puede describir con exactitud todo lo relacionado con la descripción del curso.</span>
        </div>
    </div>

    <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
            <a type="reset" class="btn btn-default" href="{{ route('profesor.curso.ver', ['curs_id' => $curso->curs_id]) }}">Regresar</a>
            <button type="submit" class="btn btn-primary">Editar Curso</button>
        </div>
    </div>
</form>

@endsection

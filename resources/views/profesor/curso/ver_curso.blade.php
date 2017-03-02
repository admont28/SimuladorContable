@extends('profesor.template.main')

@section('title',' Sección de Ver cursos')

@section('active','#profesor-curso')

@section('content')

    <form class="form-horizontal" action="{{ route('profesor.curso.put',['id' => $curso->curs_id]) }}" method="POST">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
      <fieldset>
        <h2>ESTAS VIENDO EL CURSO</h2>
        <div class="form-group">
          <label for="nombre_curso" class="col-lg-2 control-label">Nombre del curso</label>
          <div class="col-lg-10">
            <label for="nombre_curso" class="col-lg-2 control-label" id="nombre_curso" name="nombre_curso">{{ $curso->curs_nombre }} </label>
          </div>
        </div>

        <div class="form-group">
             <label for="introduccion_curso" class="col-lg-2 control-label">Introducción del curso</label>
             <div class="col-lg-10">
                 <label for="nombre_curso" class="col-lg-2 control-label" id="introduccion_curso" name="introduccion_curso">{{ $curso->curs_introduccion }}</label>
             </div>
           </div>


         <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <button type="reset" class="btn btn-default">Cancelar</button>
            <button type="submit" class="btn btn-primary">Editar curso</button>
          </div>
        </div>
      </fieldset>
    </form>



@endsection

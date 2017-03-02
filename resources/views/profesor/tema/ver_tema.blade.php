@extends('profesor.template.main')

@section('title','Sección de temas')

@section('active','#profesor-curso')

@section('content')

    <form class="form-horizontal" action="{{ route('profesor.tema.put',['id' => $tema->tema_id]) }}" method="POST">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
      <fieldset>
        <h2>ESTAS VIENDO EL TEMA</h2>
        <div class="form-group">
          <label for="tema_titulo" class="col-lg-2 control-label">Titulo del tema</label>
          <div class="col-lg-10">
            <label for="tema_titulo" class="col-lg-2 control-label" id="tema_titulo" name="tema_titulo">{{ $tema->tema_titulo }} </label>
          </div>
        </div>

        <div class="form-group">
             <label for="introduccion_curso" class="col-lg-2 control-label"> Curso al que pertenece</label>
             <div class="col-lg-10">
                 <label for="curso_nombre" class="col-lg-2 control-label" id="curso_nombre" name="curso_nombre">{{ $tema->curso->curs_nombre }}</label>
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

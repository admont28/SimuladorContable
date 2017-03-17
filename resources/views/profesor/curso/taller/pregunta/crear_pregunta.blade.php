@extends('profesor.template.main')

@section('title', 'Sección de preguntas')

@section('active','#profesor-preguntas')

@section('content')

<form class="form-horizontal" action="{{ route('profesor.crearpregunta.post',['taller'=>$taller]) }}" method="post">
    {{ csrf_field() }}


    <div class="form-group">
      <label for="texto_preugnta" class="col-lg-2 control-label">Texto de la pregunta</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="texto_pregunta" placeholder="Texto de la pregunta" name="texto_pregunta">
      </div>
    </div>

<div class="form-group">
  <label for="tipo_pregunta" class="col-lg-2 control-label">Tipo</label>
    <div class="col-lg-10">
      <select class="form-control" id="tipo_pregunta" name="tipo_pregunta">
        <option>multiple</option>
        <option>unica</option>
        <option>abierta</option>
        <option>archivo</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="porcentaje_pregunta" class="col-lg-2 control-label">Porcentaje</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="porcentaje_pregunta" placeholder="Porcentaje de la pregunta" name="porcentaje_pregunta">
    </div>
  </div>

  <div class="form-group">
    <label for="Taller_id" class="col-lg-2 control-label">taller</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="porcentaje_pregunta" placeholder="Porcentaje de la pregunta" name="porcentaje_pregunta">
    </div>
  </div>






    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <a href="{{ route('profesor.taller') }}"  class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-primary">Crear Taller</button>
      </div>
    </div>

</form>



@endsection

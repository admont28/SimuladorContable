@extends('profesor.template.main')

@section('title', 'Sección de preguntas')

@section('active','#profesor-preguntas')

@section('content')

<form class="form-horizontal" action="{{ route('profesor.curso.taller.pregunta.crear.post',['curs_id'=>$taller->curs_id,'tall_id'=>$taller->tall_id]) }}" method="post">
    {{ csrf_field() }}


    <div class="form-group">
      <label for="texto_pregunta" class="col-lg-2 control-label">Texto de la pregunta</label>
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
      <div class="col-lg-10 col-lg-offset-2">
        <a href="{{ route('profesor.curso.taller.ver',['curs_id'=> $taller->curs_id,'tall_id'=>$taller->tall_id]) }}"  class="btn btn-default">Regresar</a>
        <button type="submit" class="btn btn-primary">Crear Pregunta</button>
      </div>
    </div>

</form>



@endsection

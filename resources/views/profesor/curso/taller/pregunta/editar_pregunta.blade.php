@extends('profesor.template.main')

@section('title-head', 'Editar Pregunta')

@section('title', 'Editar pregunta para el taller: <strong>'.$taller->tall_nombre.'</strong>')

@section('active','#profesor-pregunta')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.taller.pregunta.editar.put',['curs_id' => $taller->curs_id, 'tall_id' => $taller->tall_id,'preg_id'=>$pregunta->preg_id]) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}

            <div class="form-group">
              <label for="texto_pregunta" class="col-lg-2 control-label">Texto de la pregunta</label>
              <div class="col-lg-10">
                <input type="text" class="form-control" id="texto_pregunta" placeholder="Texto de la pregunta" name="texto_pregunta" value="{{ $pregunta->preg_texto }}">
              </div>
            </div>


            <div class="form-group">
              <label for="tipo_pregunta" class="col-lg-2 control-label">Tipo</label>
                <div class="col-lg-10">
                  <select class="form-control" id="tipo_pregunta" name="tipo_pregunta" value="{{ $pregunta->preg_tipo }}">
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
                  <input type="text" class="form-control" id="porcentaje_pregunta" placeholder="Porcentaje de la pregunta" name="porcentaje_pregunta" value="{{ $pregunta->preg_porcentaje }}">
                </div>
              </div>


            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="{{ route('profesor.curso.taller.ver',['curs_id' => $taller->curs_id,'tall_id'=>$taller->tall_id]) }}"  class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Editar Pregunta</button>
                </div>
            </div>
        </form>
    </div>
@endsection

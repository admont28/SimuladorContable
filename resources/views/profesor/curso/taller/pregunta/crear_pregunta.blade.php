@extends('profesor.template.main')

@section('title-head', 'Crear Pregunta')

@section('title', 'Crear pregunta para el taller: <strong>'.$taller->tall_nombre.'</strong>')

@section('active','#profesor-curso')

@section('content')
    <form class="form-horizontal" action="{{ route('profesor.curso.taller.pregunta.crear.post',['curs_id'=>$taller->curs_id,'tall_id'=>$taller->tall_id]) }}" method="post">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('texto_pregunta') ? ' has-error' : '' }}">
            <label for="texto_pregunta" class="col-lg-2 control-label">Texto de la pregunta</label>
            <div class="col-lg-10">
                <input type="text" class="form-control" id="texto_pregunta" placeholder="Ingrese el texto de la pregunta, máximo 500 caracteres" name="texto_pregunta">
                @if ($errors->has('texto_pregunta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('texto_pregunta') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('tipo_pregunta') ? ' has-error' : '' }}">
            <label for="tipo_pregunta" class="col-lg-2 control-label">Tipo</label>
            <div class="col-lg-10">
                <select class="form-control" id="tipo_pregunta" name="tipo_pregunta">
                    @foreach ($opciones as $opcion)
                        <option value="{{ $opcion }}">{{ $opcion }}</option>
                    @endforeach
                </select>
                <span class="help-block">
                    <strong>¡Cuidado! el tipo de la pregunta no podrá ser modificado después.</strong>
                </span>
            </div>
        </div>
        <div class="form-group {{ $errors->has('porcentaje_pregunta') ? ' has-error' : '' }}">
            <label for="porcentaje_pregunta" class="col-lg-2 control-label">Porcentaje</label>
            <div class="col-lg-10">
                <input type="number" min="0.1" max="5.0" step="0.1" class="form-control" id="porcentaje_pregunta" placeholder="Ingrese el porcentaje de la pregunta, min: 0,1 - max: 5" name="porcentaje_pregunta">
                @if ($errors->has('porcentaje_pregunta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('porcentaje_pregunta') }}</strong>
                    </span>
                @endif
                <span class="help-block">
                    <strong>Use la coma para separar el número entero del número décimal. Ej: 3,0</strong>
                </span>
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

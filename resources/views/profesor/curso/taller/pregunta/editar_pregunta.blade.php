@extends('profesor.template.main')

@section('title-head', 'Editar Pregunta')

@section('title', 'Editar pregunta para el taller: <strong>'.$taller->tall_nombre.'</strong>')

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.taller.pregunta.editar.put',['curs_id' => $taller->curs_id, 'tall_id' => $taller->tall_id,'preg_id'=>$pregunta->preg_id]) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('texto_pregunta') ? ' has-error' : '' }}">
                <label for="texto_pregunta" class="col-lg-2 control-label">Texto de la pregunta</label>
                <div class="col-lg-10">
                    <textarea class="form-control" id="texto_pregunta" placeholder="Ingrese el texto de la pregunta, máximo 500 caracteres." name="texto_pregunta" rows="5">@if(old('texto_pregunta') != NULL){{ old('texto_pregunta') }}@else{{ $pregunta->preg_texto }}@endif</textarea>
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
                    <select class="form-control" id="tipo_pregunta" name="tipo_pregunta" disabled="disabled">
                        @foreach ($opciones as $opcion)
                            <option value="{{ $opcion }}" @if($pregunta->preg_tipo == $opcion) {{'selected=selected'}} @endif>{{ $opcion }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('tipo_pregunta'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tipo_pregunta') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('porcentaje_pregunta') ? ' has-error' : '' }}">
                <label for="porcentaje_pregunta" class="col-lg-2 control-label">Porcentaje</label>
                <div class="col-lg-10">
                    <input type="number" min="0.1" max="5.0" step="0.1" class="form-control" id="porcentaje_pregunta" placeholder="Ingrese el porcentaje de la pregunta, min: 0,1 - max: 5" name="porcentaje_pregunta" value="@if(old('porcentaje_pregunta') != NULL){{ old('porcentaje_pregunta') }}@else{{ $pregunta->preg_porcentaje }}@endif">
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
                    <a href="{{ route('profesor.curso.taller.ver',['curs_id' => $taller->curs_id,'tall_id'=>$taller->tall_id]) }}"  class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Editar Pregunta</button>
                </div>
            </div>
        </form>
    </div>
@endsection

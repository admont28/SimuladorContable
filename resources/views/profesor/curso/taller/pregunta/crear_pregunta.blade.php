@extends('profesor.template.main')

@section('title-head', 'Crear Pregunta')

@section('title', 'Crear pregunta para el taller: <strong>'.$taller->tall_nombre.'</strong>')

@section('active','#profesor-curso')

@section('content')
    <form class="form-horizontal" action="{{ route('profesor.curso.taller.pregunta.crear.post',['curs_id'=>$taller->curs_id,'tall_id'=>$taller->tall_id]) }}" method="post" id="formulario-crear-pregunta">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('texto_pregunta') ? ' has-error' : '' }}">
            <label for="texto_pregunta" class="col-lg-2 control-label">Texto de la pregunta</label>
            <div class="col-lg-10">
                <textarea class="form-control" id="texto_pregunta" placeholder="Ingrese el texto de la pregunta, máximo 500 caracteres." name="texto_pregunta" rows="5" autofocus="autofocus" required="required">{{ old('texto_pregunta') }}</textarea>
                @if ($errors->has('texto_pregunta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('texto_pregunta') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group {{ $errors->has('tipo_pregunta') ? ' has-error' : '' }}">
            <label for="tipo_pregunta" class="col-lg-2 control-label">Tipo de pregunta</label>
            <div class="col-lg-10">
                <select class="form-control" id="tipo_pregunta" name="tipo_pregunta" required="required">
                    @foreach ($opciones as $opcion)
                        <option value="{{ $opcion }}" @if(old('tipo_pregunta') == $opcion) {{ 'selected=selected'}} @endif>{{ $opcion }}</option>
                    @endforeach
                </select>
                <span class="help-block">
                    <strong>¡Cuidado! el tipo de la pregunta no podrá ser modificado después.</strong>
                </span>
            </div>
        </div>
        <div class="form-group {{ $errors->has('porcentaje_pregunta') ? ' has-error' : '' }}">
            <label for="porcentaje_pregunta" class="col-lg-2 control-label">Porcentaje de la pregunta</label>
            <div class="col-lg-10">
                <div class="input-group">
                    <input type="number" min="1" max="100" step="1" class="form-control" id="porcentaje_pregunta" placeholder="Ingrese el porcentaje de la pregunta, min: 1 - max: 100" name="porcentaje_pregunta" value="{{ old('porcentaje_pregunta') }}" required="required">
                    <span class="input-group-addon"> % </span>
                </div>
                @if ($errors->has('porcentaje_pregunta'))
                    <span class="help-block">
                        <strong>{{ $errors->first('porcentaje_pregunta') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-10 col-lg-offset-2">
                <a href="{{ route('profesor.curso.taller.ver',['curs_id'=> $taller->curs_id,'tall_id'=>$taller->tall_id]) }}"  class="btn btn-default">Regresar</a>
                <button type="submit" class="btn btn-primary" id="btn-crear-pregunta">Crear Pregunta</button>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn-crear-pregunta").click(function(event) {
                event.preventDefault();
                swal({
                    title: '¿Está seguro de esta acción?',
                    text: 'El campo tipo de pregunta no podrá ser modificado después, Por favor confirme.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, continuar',
                    cancelButtonText: 'No, cancelar'
                }).then(function (option) {
                    if(option === true){
                        $("#formulario-crear-pregunta").submit();
                        return true;
                    }else{
                        return false;
                    }
                });
            });
        });
    </script>
@endpush

@extends('profesor.template.main')

@section('title', 'Sección de talleres')

@section('active','#profesor-taller')

@section('content')

<form class="form-horizontal" action="{{ route('profesor.creartaller.post') }}" method="post">
    {{ csrf_field() }}
  <fieldset>
    <h2>CREAR</h2>
    <div class="form-group">
      <label for="nombre_taller" class="col-lg-2 control-label">Nombre del taller</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="nombre_taller" placeholder="Nombre del taller" name="nombre_taller">
      </div>
    </div>

<div class="form-group">
  <label for="tipo_taller" class="col-lg-2 control-label">Tipo</label>
    <div class="col-lg-10">
      <select class="form-control" id="tipo_taller" name="tipo_taller">
        <option>diagnostico</option>
        <option>teorico</option>
        <option>practico</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="curso_taller" class="col-lg-2 control-label">Curso</label>
    <div class="col-lg-10">
      <input type="text" class="form-control" id="curso_taller" placeholder="Curso del taller" name="curso_taller">
    </div>
  </div>


  <div class="form-group">
    <label for="tiempo_taller" class="col-lg-2 control-label">Tiempo del taller</label>
    <div class="col-lg-10">
        <div class='input-group date' >
              <input type='text' class="form-control" name="tiempo_taller" placeholder="Seleccione el tiempo máximo del taller" id='tiempo_taller' />
                  <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                  </span>
        </div>
    </div>

  </div>

  <div class="form-group {{ $errors->has('tema_rutaarchivo') ? ' has-error' : '' }}">
      <label for="taller_rutaarchivo" class="col-lg-2 control-label">Archivo</label>
      <div class="col-lg-10">
          <input type="file" class="form-control" id="taller_rutaarchivo" placeholder="ruta del archivo" name="taller_rutaarchivo">
          @if ($errors->has('tema_rutaarchivo'))
              <span class="help-block">
                  <strong>{{ $errors->first('taller_rutaarchivo') }}</strong>
              </span>
          @endif
      </div>
  </div>



    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <a href="{{ route('profesor.taller') }}"  class="btn btn-default">Cancelar</a>
        <button type="submit" class="btn btn-primary">Crear Taller</button>
      </div>
    </div>
  </fieldset>
</form>



@endsection
@section('scripts')
<script type="text/javascript">
            $(function () {
                    $('#tiempo_taller').datetimepicker({
                        format: 'YYYY-MM-DD HH:mm',
                        extraFormats: [ 'YYYY-MM-DD' ],
                        sideBySide: true
                });

            });
        </script>
@endsection

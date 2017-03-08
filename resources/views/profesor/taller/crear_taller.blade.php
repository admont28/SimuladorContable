@extends('profesor.template.main')

@section('title', 'Sección de talleres')

@section('active','#profesor-taller')

@section('content')

<form class="form-horizontal">
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
        <option>taller diagnóstico</option>
        <option>taller teórico</option>
        <option>taller práctico</option>
      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="tiempo_taller2" class="col-lg-2 control-label">Tiempo del taller</label>
    <div class="col-lg-10">
      <input type="date" class="form-control" id="tiempo_taller2" placeholder="Nombre del taller" name="tiempo_taller2">
    </div>
  </div>

  <div class="form-group">
    <label for="tiempo_taller" class="col-lg-2 control-label">Tiempo del taller</label>
    <div class="col-lg-10">
        <div class='input-group date' >
              <input type='text' class="form-control" placeholder="Seleccione el tiempo máximo del taller" id='tiempo_taller' />
                  <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                  </span>
        </div>
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
                    sideBySide: true
                });
            });
        </script>
@endsection

@extends('profesor.template.main')

@section('title', 'Sección de talleres')

@section('content')

<form class="form-horizontal">
  <fieldset>
    <h2>CREAR</h2>
    <div class="form-group">
      <label for="nombre_curso" class="col-lg-2 control-label">Nombre del curso</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="nombre_curso" placeholder="Nombre del curso" name="nombre_curso">
      </div>
    </div>

    <div class="jumbotron">
      <h1>Introducción</h1>
      <p></p>
    </div>

     <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancelar</button>
        <button type="submit" class="btn btn-primary">Crear Curso</button>
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

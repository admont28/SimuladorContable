@extends('profesor.template.main')

@section('title', 'Sección de temas')

@section('content')
<form class="form-horizontal">
  <fieldset>
    <h2>CREAR</h2>
    <div class="form-group">
      <label for="titulo_tema" class="col-lg-2 control-label">Título del tema</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="titulo_tema" placeholder="Nombre del curso" name="titulo_tema">
      </div>
    </div>

    <div class="form-group">
      <label for="ruta_archivo" class="col-lg-2 control-label">Ruta del Archivo</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="ruta_archivo" placeholder="Nombre del curso" name="ruta_archivo">
      </div>
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

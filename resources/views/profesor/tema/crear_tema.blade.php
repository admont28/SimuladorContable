@extends('profesor.template.main')

@section('title', 'Sección de temas')

@section('content')
<form class="form-horizontal" action="{{ route('profesor.creartema.post') }}" method="post">
    {{ csrf_field() }}
  <fieldset>
    <h2>CREAR</h2>
    <div class="form-group">
      <label for="titulo_tema" class="col-lg-2 control-label">Título del tema</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="titulo_tema" placeholder="Nombre del tema" name="titulo_tema">
      </div>
    </div>

    <div class="form-group">
      <label for="curso" class="col-lg-2 control-label">Curso</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="curso" placeholder="curso" name="curso">
      </div>
    </div>

    <div class="form-group">
      <label for="tema_rutaarchivo" class="col-lg-2 control-label">ruta archivo</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="tema_rutaarchivo" placeholder="ruta del archivo" name="tema_rutaarchivo">
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

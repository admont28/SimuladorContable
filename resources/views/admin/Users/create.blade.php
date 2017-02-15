@extends('admin.template.main')

@section('title', 'Registrarse')

@section('content')
<form class="form-horizontal" method="post" >
  <fieldset>

    <div class="form-group">
      <label  class="col-lg-2 control-label">Nombre</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="inputNombre" placeholder="Escriba su nombre">
      </div>
    </div>

    <div class="form-group">
      <label for="inputEmail" class="col-lg-2 control-label">Email</label>
      <div class="col-lg-10">
        <input type="text" class="form-control" id="inputEmail" placeholder="Escriba su correo electronico">
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword" class="col-lg-2 control-label">Contraseña</label>
      <div class="col-lg-10">
        <input type="password" class="form-control" id="inputPassword" placeholder="Escriba su contraseña ">
        <div class="checkbox">
          <label>
            <input type="checkbox"> Recordar contraseña
          </label>

        </div>
      </div>
    </div>


    <div class="form-group">
      <label for="select" class="col-lg-2 control-label">Rol</label>
      <div class="col-lg-10">
        <select class="form-control" id="select" >
          <option>PROFESOR</option>
          <option>ESTUDIANTE</option>
            </select>
        <br>

      </div>
    </div>
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        <button type="reset" class="btn btn-default">Cancelar</button>
        <button type="submit" class="btn btn-primary">Registrarse</button>
      </div>
    </div>
  </fieldset>
</form>

@endsection

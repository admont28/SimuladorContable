@extends('profesor.template.main')

@section('title-head', 'Crear taller NIIF')

@section('title')
    {!! 'Crear taller NIIF para el curso: <strong>'.$curso->curs_nombre.'</strong>' !!}
@endsection

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.taller.crear.tallerniif.post', ['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id]) }}" method="post" id="form-tallerniif">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label">Taller:</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{ $taller->tall_nombre }}</p>
                </div>
            </div>
            <div class="form-group {{ $errors->has('nombre_empresa') ? ' has-error' : '' }}">
                <label for="nombre_empresa" class="col-lg-2 control-label">Nombre de la empresa:</label>
                <div class="col-lg-10">
                    <input type="text" maxlength="100" class="form-control" id="nombre_empresa" placeholder="Ingrese la cantidad de tablas a crear para solucionar el taller de asientos contables, esto hará que aparezcan varias tablas con la tabla plantilla" name="nombre_empresa" value="{{ old('nombre_empresa') }}" autofocus="autofocus" required="required">
                    @if ($errors->has('nombre_empresa'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre_empresa') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('periodo') ? ' has-error' : '' }}">
                <label for="periodo" class="col-lg-2 control-label">Periodo:</label>
                <div class="col-lg-10">
                    <input type="text" maxlength="100" class="form-control" id="periodo" placeholder="Ingrese la cantidad de tablas a crear para solucionar el taller de asientos contables, esto hará que aparezcan varias tablas con la tabla plantilla" name="periodo" value="{{ old('periodo') }}" autofocus="autofocus" required="required">
                    @if ($errors->has('periodo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('periodo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="{{ route('profesor.curso.taller.ver',['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id]) }}"  class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-enviar">Crear Taller NIIF</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            /**
             * Función para pedir confirmación del usuario antes de eliminar un elemento de la tabla.
             */
            $(document).on('click', '.btn-enviar', function(event) {
                event.preventDefault();
                var form = $('#form-tallerniif');
                swal({
                    title: '¿Está seguro de esta acción?',
                    text: "Al marcar el taller con el sub-tipo: Taller NIIF no podrá deshacer la acción. Por favor revisa la información suministrada y confirma.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, continuar',
                    cancelButtonText: 'No, cancelar'
                }).then(function (option) {
                    if(option === true){
                        form.submit();
                        return true;
                    }else{
                        return false;
                    }
                })
            });
        });
    </script>
@endpush

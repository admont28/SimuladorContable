@extends('profesor.template.main')

@section('title-head', 'Crear taller de nómina')

@section('title', 'Crear taller de nómina para el curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.taller.crear.tallernomina.post', ['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id]) }}" method="post" id="form-tallernomina">
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-sm-2 control-label">Taller:</label>
                <div class="col-sm-10">
                    <p class="form-control-static">{{ $taller->tall_nombre }}</p>
                </div>
            </div>
            <div class="form-group {{ $errors->has('cantidad_filas_tabla') ? ' has-error' : '' }}">
                <label for="cantidad_filas_tabla" class="col-lg-2 control-label">Cantidad de filas de la tabla</label>
                <div class="col-lg-10">
                    <input type="number" min="1" step="1" class="form-control" id="cantidad_filas_tabla" placeholder="Ingrese la cantidad de filas que tendrá la tabla del taller de asientos contables para ser solucionado" name="cantidad_filas_tabla" value="{{ old('cantidad_filas_tabla') }}">
                    @if ($errors->has('cantidad_filas_tabla'))
                        <span class="help-block">
                            <strong>{{ $errors->first('cantidad_filas_tabla') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('deduccion_prestamo') ? ' has-error' : '' }}">
                <label for="deduccion_prestamo" class="col-lg-2 control-label">¿Deducción prestamo?</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="deduccion_prestamo" placeholder="Ingrese si el taller tiene deducción de prestamo" name="deduccion_prestamo" value="{{ old('deduccion_prestamo') }}">
                    @if ($errors->has('deduccion_prestamo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('deduccion_prestamo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('deduccion_2') ? ' has-error' : '' }}">
                <label for="deduccion_2" class="col-lg-2 control-label">¿Deducción dos?</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="deduccion_2" placeholder="Ingrese si el taller tiene deducción dos" name="deduccion_2" value="{{ old('deduccion_2') }}">
                    @if ($errors->has('deduccion_2'))
                        <span class="help-block">
                            <strong>{{ $errors->first('deduccion_2') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('deduccion_3') ? ' has-error' : '' }}">
                <label for="deduccion_3" class="col-lg-2 control-label">¿Deducción tres?</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="deduccion_3" placeholder="Ingrese si el taller tiene deducción tres" name="deduccion_3" value="{{ old('deduccion_3') }}">
                    @if ($errors->has('deduccion_3'))
                        <span class="help-block">
                            <strong>{{ $errors->first('deduccion_3') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="{{ route('profesor.curso.taller.ver',['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id]) }}"  class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-enviar">Crear Taller de Asientos Contables</button>
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
                var form = $('#form-tallernomina');
                swal({
                    title: '¿Está seguro de esta acción?',
                    text: "Al marcar el taller con el sub-tipo: Taller de Nómina no podrá deshacer la acción. Por favor confirme.",
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

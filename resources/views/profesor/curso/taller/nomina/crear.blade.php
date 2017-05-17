@extends('profesor.template.main')

@section('title-head', 'Crear taller de nómina')

@section('title')
    {!! 'Crear taller de nómina para el curso: <strong>'.$curso->curs_nombre.'</strong>' !!}
@endsection

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
            <div class="form-group {{ $errors->has('deduccion_uno') ? ' has-error' : '' }}">
                <label for="deduccion_uno" class="col-lg-2 control-label">¿Deducción uno?</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="deduccion_uno" placeholder="Ingrese si el taller tiene algúna deducción, esto hará que aparezca una columna más en la tabla plantilla" name="deduccion_uno" value="{{ old('deduccion_uno') }}" autofocus="autofocus">
                    @if ($errors->has('deduccion_uno'))
                        <span class="help-block">
                            <strong>{{ $errors->first('deduccion_uno') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('deduccion_dos') ? ' has-error' : '' }}">
                <label for="deduccion_dos" class="col-lg-2 control-label">¿Deducción dos?</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="deduccion_dos" placeholder="Ingrese si el taller tiene algúna deducción, esto hará que aparezca una columna más en la tabla plantilla" name="deduccion_dos" value="{{ old('deduccion_dos') }}">
                    @if ($errors->has('deduccion_dos'))
                        <span class="help-block">
                            <strong>{{ $errors->first('deduccion_dos') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('deduccion_tres') ? ' has-error' : '' }}">
                <label for="deduccion_tres" class="col-lg-2 control-label">¿Deducción tres?</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="deduccion_tres" placeholder="Ingrese si el taller tiene algúna deducción, esto hará que aparezca una columna más en la tabla plantilla" name="deduccion_tres" value="{{ old('deduccion_tres') }}">
                    @if ($errors->has('deduccion_tres'))
                        <span class="help-block">
                            <strong>{{ $errors->first('deduccion_tres') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="{{ route('profesor.curso.taller.ver',['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id]) }}"  class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary btn-enviar">Crear Taller de Nómina</button>
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
                    text: "Al marcar el taller con el sub-tipo: Taller de Nómina no podrá deshacer la acción. Por favor revisa la información suministrada y confirma.",
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

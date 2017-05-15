@extends('profesor.template.main')

@section('title-head', 'Crear taller')

@section('title', 'Crear taller para el curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.taller.crear.post', ['curs_id' => $curso->curs_id]) }}" method="post" enctype="multipart/form-data" id="formulario-crear-taller">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('nombre_taller') ? ' has-error' : '' }}">
                <label for="nombre_taller" class="col-lg-2 control-label">Nombre del taller</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="nombre_taller" placeholder="Ingrese el nombre del taller" name="nombre_taller" value="{{ old('nombre_taller') }}">
                    @if ($errors->has('nombre_taller'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre_taller') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('tipo_taller') ? ' has-error' : '' }}">
                <label for="tipo_taller" class="col-lg-2 control-label">Tipo</label>
                <div class="col-lg-10">
                    <select class="form-control" id="tipo_taller" name="tipo_taller">
                        @foreach ($opciones as $opcion)
                            <option value="{{ $opcion }}" @if(old('tipo_taller') == $opcion) {{'selected=selected'}} @endif>{{ $opcion }}</option>
                        @endforeach
                    </select>
                    <span class="help-block">
                        <strong>Seleccione el tipo de taller que está creando. Este tipo no podrá ser modificado después.</strong>
                    </span>
                    @if ($errors->has('tipo_taller'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tipo_taller') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('tiempo_taller') ? ' has-error' : '' }}">
                <label for="tiempo_taller" class="col-lg-2 control-label">Tiempo del taller</label>
                <div class="col-lg-10">
                    <div class='input-group date' >
                        <input type="text" class="form-control" name="tiempo_taller" placeholder="Seleccione el tiempo máximo del taller" id="tiempo_taller" value="{{ old('tiempo_taller') }}"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                    @if ($errors->has('tiempo_taller'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tiempo_taller') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('taller_rutaarchivo') ? ' has-error' : '' }}">
                <label for="taller_rutaarchivo" class="col-lg-2 control-label">Archivo</label>
                <div class="col-lg-10">
                    <input type="file" class="form-control" id="taller_rutaarchivo" placeholder="ruta del archivo" name="taller_rutaarchivo">
                    @if ($errors->has('taller_rutaarchivo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('taller_rutaarchivo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="{{ route('profesor.curso.ver',['curs_id' => $curso->curs_id]) }}"  class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary" id="btn-crear-taller">Crear Taller</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(function () {
                $('#tiempo_taller').datetimepicker({
                    format: 'YYYY-MM-DD HH:mm:ss',
                    sideBySide: true,
                    showTodayButton: true,
                    showClear: true,
                    showClose: true,
                    toolbarPlacement: 'top',
                    minDate: new Date(),
                    tooltips: {
                        today: 'Hoy',
                        clear: 'Limpiar selección',
                        close: 'Cerrar ventana',
                        selectMonth: 'Seleccionar mes',
                        prevMonth: 'Mes anterior',
                        nextMonth: 'Siguiente mes',
                        selectYear: 'Seleccionar año',
                        prevYear: 'Año anterior',
                        nextYear: 'Siguiente año',
                        selectDecade: 'Seleccionar década',
                        prevDecade: 'Década anterior',
                        nextDecade: 'Siguiente década',
                        prevCentury: 'Siglo anterior',
                        nextCentury: 'Siguiente siglo'
                    }
                });
                $('#tiempo_taller').val('{{ old('tiempo_taller') }}');
            });
            $("#btn-crear-taller").click(function(event) {
                event.preventDefault();
                swal({
                    title: '¿Está seguro de esta acción?',
                    text: 'El campo tipo de taller no podrá ser modificado después, Por favor confirme.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, continuar',
                    cancelButtonText: 'No, cancelar'
                }).then(function (option) {
                    if(option === true){
                        $("#formulario-crear-taller").submit();
                        return true;
                    }else{
                        return false;
                    }
                });
            });
        });
    </script>
@endpush

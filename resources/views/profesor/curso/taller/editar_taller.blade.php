@extends('profesor.template.main')

@section('title-head', 'Editar taller')

@section('title')
    {!! 'Editar taller para el curso: <strong>'.$curso->curs_nombre.'</strong>' !!}
@endsection

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.taller.editar.put',['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id]) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('nombre_taller') ? ' has-error' : '' }}">
                <label for="nombre_taller" class="col-lg-2 control-label">Nombre del taller</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="nombre_taller" placeholder="Ingrese el nombre del taller" name="nombre_taller" value="{{ $taller->tall_nombre }}" autofocus="autofocus" required="required">
                    @if ($errors->has('nombre_taller'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre_taller') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="tipo_taller" class="col-lg-2 control-label">Tipo</label>
                <div class="col-lg-10">
                    <select class="form-control" id="tipo_taller" name="tipo_taller" disabled="disabled" required="required">
                        @foreach ($opciones as $opcion)
                            <option value="{{ $opcion }}" @if($taller->tall_tipo == $opcion) {{'selected=selected'}} @endif>{{ $opcion }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group {{ $errors->has('tiempo_taller') ? ' has-error' : '' }}">
                <label for="tiempo_taller" class="col-lg-2 control-label">Tiempo del taller</label>
                <div class="col-lg-10">
                    <div class='input-group date' >
                        <input type="text" class="form-control" name="tiempo_taller" placeholder="Seleccione el tiempo máximo del taller" id="tiempo_taller" value="{{ $taller->tall_tiempo }}" required="required"/>
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
                    <span class="help-block">
                        <strong>Si selecciona un archivo, se reemplazará el archivo actual por el nuevo.</strong>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="{{ route('profesor.curso.taller.ver',['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id]) }}"  class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Editar Taller</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
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

            $("#tiempo_taller").val('{{ $taller->tall_tiempo }}');
        });
    </script>
@endpush

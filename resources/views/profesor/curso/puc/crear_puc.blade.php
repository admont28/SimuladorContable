@extends('profesor.template.main')

@section('title-head', 'Cargar archivo PUC')

@section('title', 'Cargar archivo PUC para el curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <div class="alert alert-warning" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>¡Cuidado!</strong> Al cargar un nuevo archivo, serán eliminados todos los registros del PUC actual y reemplazados por los que contenga el nuevo archivo.
        </div>
    </div>
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.puc.crear.post', ['curs_id' => $curso->curs_id ]) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('archivo_puc') ? ' has-error' : '' }}">
                <label for="archivo_puc" class="col-lg-2 control-label">Archivo PUC</label>
                <div class="col-lg-10">
                    <input type="file" class="form-control" id="archivo_puc" placeholder="ruta del archivo" name="archivo_puc" value="{{ old('archivo_puc') }}">
                    @if ($errors->has('archivo_puc'))
                        <span class="help-block">
                            <strong>{{ $errors->first('archivo_puc') }}</strong>
                        </span>
                    @endif
                    <span class="help-block">
                        <strong>El archivo debe ser un archivo separado por comas .csv (se puede generar mediante Excel), la primer columna se debe llamar "CODIGO" y la segunda columna "NOMBRE".</strong>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="{{ route('profesor.curso.ver', ['curs_id' => $curso->curs_id]) }}" class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Cargar Archivo PUC</button>
                </div>
            </div>
        </form>
    </div>
@endsection

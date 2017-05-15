@extends('profesor.template.main')

@section('title-head', 'Editar materia')

@section('title', 'Crear materia para el curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.materia.editar.put', ['curs_id' => $curso->curs_id, 'mate_id' => $materia->mate_id ]) }}" method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('mate_nombre') ? ' has-error' : '' }}">
                <label for="mate_nombre" class="col-lg-2 control-label">Nombre de la materia</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="mate_nombre" placeholder="Ingrese el nombre de la materia" name="mate_nombre" value="{{ $materia->mate_nombre }}" autofocus="autofocus" required="required">
                    @if ($errors->has('mate_nombre'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mate_nombre') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('mate_tema') ? ' has-error' : '' }}">
                <label for="mate_tema" class="col-lg-2 control-label">Tema de la materia</label>
                <div class="col-lg-10">
                    <textarea type="text" class="form-control" id="mate_tema" placeholder="Ingrese el tema de la materia" name="mate_tema" rows="5" required="required">{{ $materia->mate_tema }}</textarea>
                    @if ($errors->has('mate_tema'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mate_tema') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('mate_rutaarchivo') ? ' has-error' : '' }}">
                <label for="mate_rutaarchivo" class="col-lg-2 control-label">Archivo</label>
                <div class="col-lg-10">
                    <input type="file" class="form-control" id="mate_rutaarchivo" placeholder="ruta del archivo" name="mate_rutaarchivo">
                    @if ($errors->has('mate_rutaarchivo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('mate_rutaarchivo') }}</strong>
                        </span>
                    @endif
                    <span class="help-block">
                        <strong>Si selecciona un archivo, se reemplazará el archivo actual por el nuevo.</strong>
                    </span>
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="{{ route('profesor.curso.ver', ['curs_id' => $curso->curs_id]) }}" class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Editar Materia</button>
                </div>
            </div>
        </form>
    </div>
@endsection

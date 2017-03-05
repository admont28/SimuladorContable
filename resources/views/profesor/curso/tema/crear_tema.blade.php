@extends('profesor.template.main')

@section('title', 'Crear tema para el curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.tema.crear.post', ['curs_id' => $curso->curs_id ]) }}" method="post">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('tema_titulo') ? ' has-error' : '' }}">
                <label for="tema_titulo" class="col-lg-2 control-label">Título del tema</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" id="tema_titulo" placeholder="Ingrese el tículo del tema" name="tema_titulo">
                    @if ($errors->has('tema_titulo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tema_titulo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('tema_rutaarchivo') ? ' has-error' : '' }}">
                <label for="tema_rutaarchivo" class="col-lg-2 control-label">Archivo</label>
                <div class="col-lg-10">
                    <input type="file" class="form-control" id="tema_rutaarchivo" placeholder="ruta del archivo" name="tema_rutaarchivo">
                    @if ($errors->has('tema_rutaarchivo'))
                        <span class="help-block">
                            <strong>{{ $errors->first('tema_rutaarchivo') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="{{ route('profesor.curso.ver', ['curs_id' => $curso->curs_id]) }}" class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Crear Tema</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@extends('profesor.template.main')

@section('title-head', 'Editar Tarifa')

@section('title')
    {!! 'Editar tarifa para el taller: <strong>'.$taller->tall_nombre.'</strong>' !!}
@endsection

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <form class="form-horizontal" action="{{ route('profesor.curso.taller.tarifa.editar.put',['curs_id' => $taller->curs_id, 'tall_id' => $taller->tall_id,'tari_id'=>$tarifa->tari_id]) }}" method="post">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('nombre_tarifa') ? ' has-error' : '' }}">
                <label for="nombre_tarifa" class="col-lg-2 control-label">Nombre de la tarifa</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="Ingrese el nombre de la tarifa" name="nombre_tarifa" value="{{ $tarifa->tari_nombre }}" autofocus="autofocus" required="required">
                    @if ($errors->has('nombre_tarifa'))
                        <span class="help-block">
                            <strong>{{ $errors->first('nombre_tarifa') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group {{ $errors->has('valor_tarifa') ? ' has-error' : '' }}">
                <label for="valor_tarifa" class="col-lg-2 control-label">Valor de la tarifa</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="Ingrese el valor de la tarifa" name="valor_tarifa" value="{{ $tarifa->tari_valor }}" required="required">
                    @if ($errors->has('valor_tarifa'))
                        <span class="help-block">
                            <strong>{{ $errors->first('valor_tarifa') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <a href="{{ route('profesor.curso.taller.ver',['curs_id' => $taller->curs_id,'tall_id'=>$taller->tall_id]).'#tabla-tarifa' }}"  class="btn btn-default">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Editar Tarifa</button>
                </div>
            </div>
        </form>
    </div>
@endsection

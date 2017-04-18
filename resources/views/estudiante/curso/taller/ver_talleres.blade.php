@extends('estudiante.template.main')

@section('title-head', 'Ver talleres de un curso')

@section('title',' Curso: <strong>'.$curso->curs_nombre.'</strong>')

@section('active','#estudiante-curso')

@section('content')
    <div class="row">
        <h2 class="text-center"><strong>TALLERES</strong></h2>
    </div>
    <div class="row">
        <div id="accordion" class="panel-group">
            @foreach ($talleres as $taller)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $taller->tall_id }}">{{ $taller->tall_nombre }}</a>
                        </h4>
                    </div>
                    <div id="collapse-{{ $taller->tall_id }}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <h3><strong>Tipo de Taller</strong></h3>
                            <p>{{ $taller->tall_tipo }}</p>
                            <h3><strong>Fecha Máxima de Envío</strong></h3>
                            <p>{{ $taller->tall_tiempo }}</p>
                            <h3><strong>Archivo Asociado</strong></h3>
                            <p><a href="{{ $taller->tall_rutaarchivo }}">{{ $taller->tall_nombrearchivo }}</a></p>
                            <div class="text-center">
                                <a href="{{ route('estudiante.curso.ver.talleres.ver.preguntas',['curs_id'=>$curso->curs_id,'tall_id'=>$taller->tall_id]) }}" class="btn btn-primary solucionar-taller" >Solucionar Taller</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a type="reset" class="btn btn-default" href="{{ route('estudiante.curso.ver.materias', ['curs_id' => $curso->curs_id]) }}">Regresar</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.solucionar-taller').click(function(event) {
                event.preventDefault();
                //accedemos a la ruta del boton que se dio click
                var hrefBoton = $(this).attr('href');
                swal({
                    title: '¿Está seguro de esta acción?',
                    text: 'Si continúa a solucionar el taller se le contará como el primer intento de solución, usted posee 2 intentos como máximo. Por favor confirme.',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, continuar',
                    cancelButtonText: 'No, cancelar'
                }).then(function (option) {
                    if(option === true){
                        window.location.href = hrefBoton;
                        return true;
                    }else{
                        return false;
                    }
                })
            });
        });
    </script>
@endpush

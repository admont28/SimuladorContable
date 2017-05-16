@extends('profesor.template.main')

@section('title-head', 'Calificaciones de un usuario')

@section('title')
    {!! 'Calificaciones del usuario: <strong>'.$usuario->name.'</strong>' !!}
@endsection

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <div  class="table-responsive" >
            <table class="table" id="usuario-table" >
                <thead>
                    <tr>
                        <td><strong>Pregunta</strong></td>
                        <td><strong>Tipo</strong></td>
                        <td><strong>Calificación</strong></td>
                        <td><strong>Porcentaje</strong></td>
                        <td><strong>Ponderado</strong></td>
                        <td><strong>Opciones</strong></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a href="{{ route('profesor.curso.taller.ver',['curs_id'=>$curso->curs_id, 'tall_id'=>$taller->tall_id]) }}"  class="btn btn-default">Regresar</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#usuario-table').DataTable({
                "dom"       : "lBfrtip",
                "buttons"   : ['reset', 'reload'],
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('profesor.curso.taller.pregunta.respuesta.calificacion.estudiante.ajax',['curs_id' => $curso->curs_id,'tall_id'=>$taller->tall_id, 'usua_id'=>$usuario->id]) }}",
                "columns" : [
                    {data: 'preg_texto', name: 'preg_texto', width: '59%'},
                    {data: 'preg_tipo', name: 'preg_tipo', width: '10%'},
                    {data: 'cali_calificacion', name: 'cali_calificacion', width: '8%'},
                    {data: 'preg_porcentaje', name: 'preg_porcentaje', width: '5%'},
                    {data: 'cali_ponderado', name: 'cali_ponderado', width: '8%'},
                    {data: 'opciones', name: 'action', orderable: false, searchable: false, width: '10%'}
                ],
                "language" : {
                    "url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
                }
            });
        });
    </script>
@endpush

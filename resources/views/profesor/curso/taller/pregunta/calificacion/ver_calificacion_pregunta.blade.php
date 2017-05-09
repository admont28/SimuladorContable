@extends('profesor.template.main')

@section('title-head', 'Sección de Preguntas Calificadas')

@section('title', 'Sección de Preguntas Calificadas')

@section('active','#profesor-curso')

@section('content')

<br>
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
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#usuario-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('profesor.curso.taller.pregunta.respuesta.calificacion.estudiante.ajax',['curs_id' => $curso->curs_id,'tall_id'=>$taller->tall_id, 'usua_id'=>$usuario->usua_id]) }}",
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

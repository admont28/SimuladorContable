@extends('estudiante.template.main')

@section('title-head', 'Sección de cursos')

@section('title', 'Sección de cursos')

@section('active','#estudiante-curso')

@section('content')

    <div class="row">
        <div  class="table-responsive" >
            <table class="table" id="curso-table" >
                <thead>
                    <tr>
                        <td><strong>ID</strong></td>
                        <td><strong>Nombre</strong></td>
                        <td><strong>Introduccion</strong></td>
                        <td><strong>Opciones</strong></td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#curso-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('estudiante.curso.verajax') }}",
                "columns" : [
                    {data: 'curs_id', name: 'curs_id', width: '5%'},
                    {data: 'curs_nombre', name: 'curs_nombre', width: '30%'},
                    {data: 'curs_introduccion', name: 'curs_introduccion', width: '10%'},
                    {data: 'opciones', name: 'action', orderable: false, searchable: false, width: '20%'}
                ],
                "language" : {
                    "url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
                }
            });
        });

    </script>
@endpush

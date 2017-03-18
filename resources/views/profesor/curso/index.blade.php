@extends('profesor.template.main')

@section('title-head', 'Sección de cusrsos')

@section('title', 'Sección de cursos')

@section('active','#profesor-curso')

@section('content')

<div class="row">
    <a href="{{ route('profesor.crearcurso',['curs_id',$curso->curs_id]) }}" class="btn btn-primary">Crear curso</a>
</div>
<br>
<div class="row">
    <div class="table-responsive">
        {!! $dataTable->table(['class' => 'table table-bordered table-condensed table-hover table-striped']) !!}
    </div>
</div>
<br>
@endsection

@push('scripts')

    <script type="text/javascript">
        $(function() {
            $('#taller-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('profesor.curso.taller.verajax',['curs_id' => $curso->curs_id]) }}",
                "columns" : [
                    {data: 'tall_id', name: 'tall_id', width: '5%'},
                    {data: 'tall_nombre', name: 'tall_nombre', width: '15%'},
                    {data: 'tall_tipo', name: 'tall_tipo', width: '40%'},
                    {data: 'tall_tiempo', name: 'tall_tiempo', width: '20%'},
                    {data: 'opciones', name: 'action', orderable: false, searchable: false, width: '20%'}
                ],
                "language" : {
                    "url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
                }
            });
        });
    </script>

@endpush

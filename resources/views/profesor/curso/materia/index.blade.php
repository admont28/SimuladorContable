@extends('profesor.template.main')

@section('title', 'Sección de temas')

@section('active','#profesor-tema')

@section('content')
<p>Bienvenido a la sección de temas por favor escoja que desea hacer:</p>

<li><a href="{{ route('profesor.creartema') }}">Crear un tema</a></li>
<li><a href="{{ route('profesor.tema.ver') }}">Ver temas disponibles</a></li>


<div class="table-responsive">
    {!! $dataTable->table(['id'=>'materia-table','class' => 'table table-bordered table-condensed table-hover table-striped']) !!}
</div>

@endsection

@section('scripts')
    <script type="text/javascript">
    $('#materia-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: 'https://datatables.yajrabox.com/eloquent/basic-data'
            });
    </script>

@endsection

@extends('profesor.template.main')

@section('title', 'Sección de cursos')

@section('active','#profesor-curso')

@section('content')

<div class="row">
    <a href="{{ route('profesor.crearcurso') }}" class="btn btn-primary">Crear curso</a>
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
{!! $dataTable->scripts() !!}
@endpush

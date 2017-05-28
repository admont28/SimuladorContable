@extends('profesor.template.main')

@section('title-head', 'Sección de cursos')

@section('title', 'Sección de cursos')

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <a href="{{ route('profesor.curso.crear') }}" class="btn btn-primary">Crear curso</a>
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
    <script type="text/javascript">
        $(document).ready(function() {
            /**
             * Función para pedir confirmación del usuario antes de eliminar un elemento de la tabla.
             */
            $(document).on('click', '.btn-eliminar', function(event) {
                event.preventDefault();
                var form = $(this).parent();
                swal({
                    title: '¿Está seguro de eliminar el elemento?',
                    text: "Esta acción no se puede deshacer. Por favor confirme.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, eliminar',
                    cancelButtonText: 'No, cancelar'
                }).then(function (option) {
                    if(option === true){
                        form.submit();
                        return true;
                    }else{
                        return false;
                    }
                })
            });
        });
    </script>
@endpush

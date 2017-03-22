<div class="row">
    <a href="{{ route('profesor.curso.taller.crear.post', ['curs_id' => $curso->curs_id]) }}" class="btn btn-primary" >Crear taller para el curso</a>
</div>
<br>
<div class="row">
    <div  class="table-responsive" >
        <table class="table" id="taller-table" >
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Nombre</strong></td>
                    <td><strong>Tipo</strong></td>
                    <td><strong>Fecha máxima de envío</strong></td>
                    <td><strong>Archivo asociado</strong></td>
                    <td><strong>Opciones</strong></td>
                </tr>
            </thead>
        </table>
    </div>
</div>
<br>

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#taller-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('profesor.curso.taller.verajax',['curs_id' => $curso->curs_id]) }}",
                "columns" : [
                    {data: 'tall_id', name: 'tall_id', width: '5%'},
                    {data: 'tall_nombre', name: 'tall_nombre', width: '30%'},
                    {data: 'tall_tipo', name: 'tall_tipo', width: '10%'},
                    {data: 'tall_tiempo', name: 'tall_tiempo', width: '15%'},
                    {data: 'tall_rutaarchivo', name: 'tall_rutaarchivo', width: '20%'},
                    {data: 'opciones', name: 'action', orderable: false, searchable: false, width: '20%'}
                ],
                "language" : {
                    "url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
                }
            });
        });
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

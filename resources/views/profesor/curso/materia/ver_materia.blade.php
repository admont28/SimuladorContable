<div class="row">
        <a href="{{ route('profesor.curso.materia.crear', ['curs_id' => $curso->curs_id]) }}" class="btn btn-primary">Crear materia para el curso</a>
</div>
<br>
<div class="row">
    <div class="table-responsive">
        <table class="table" id="ver-materias">
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Nombre de la materia</strong></td>
                    <td><strong>Tema</strong></td>
                    <td><strong>Ruta archivo</strong></td>
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
            $('#ver-materias').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('profesor.curso.materia.verajax', ['curs_id' => $curso->curs_id]) }}",
                "columns" : [
                    {data: 'mate_id', name: 'mate_id', width: '5%'},
                    {data: 'mate_nombre', name: 'mate_nombre', width: '15%'},
                    {data: 'mate_tema', name: 'mate_tema', width: '40%'},
                    {data: 'mate_rutaarchivo', name: 'mate_rutaarchivo', width: '20%'},
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

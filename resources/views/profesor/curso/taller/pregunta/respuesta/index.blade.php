<div class="row">
        <a href="{{ route('profesor.curso.taller.pregunta.respuesta.crear', ['tall_id' => $taller->tall_id,'curs_id'=>$taller->curs_id, 'preg_id' => $pregunta->preg_id]) }}" class="btn btn-primary">Crear respuesta para la pregunta</a>
</div>
<br>
<div class="row">
    <div class="table-responsive">
        <table class="table" id="ver-respuestas">
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Texto de la respuesta</strong></td>
                    <td><strong>¿Es correcta?</strong></td>
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
        $('#ver-respuestas').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('profesor.curso.taller.pregunta.respuesta.verajax', ['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id, 'preg_id' => $pregunta->preg_id]) }}",
            "columns" : [
                {data: 'remu_id', name: 'remu_id', width: '5%'},
                {data: 'remu_texto', name: 'remu_texto', width: '55%'},
                {data: 'remu_correcta', name: 'remu_correcta', width: '20%'},
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

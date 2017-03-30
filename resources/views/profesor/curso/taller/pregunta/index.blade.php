<div class="row">
    <a href="{{ route('profesor.curso.taller.pregunta.crear.post', ['tall_id' => $taller->tall_id,'curs_id'=>$taller->curs_id]) }}" class="btn btn-primary" >Crear pregunta para el taller </a>
</div>
<br>
<div class="row">
    <div  class="table-responsive" >
        <table class="table" id="pregunta-table" >
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Texto</strong></td>
                    <td><strong>Tipo</strong></td>
                    <td><strong>Porcentaje</strong></td>
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
            $('#pregunta-table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('profesor.curso.taller.pregunta.verajax',['tall_id' => $taller->tall_id,'curs_id'=>$taller->curs_id]) }}",
                "columns" : [
                    {data: 'preg_id', name: 'preg_id', width: '5%'},
                    {data: 'preg_texto', name: 'preg_texto', width: '40%'},
                    {data: 'preg_tipo', name: 'preg_tipo', width: '15%'},
                    {data: 'preg_porcentaje', name: 'preg_porcentaje', width: '10%'},
                    {data: 'opciones', name: 'action', orderable: false, searchable: false, width: '30%'}
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

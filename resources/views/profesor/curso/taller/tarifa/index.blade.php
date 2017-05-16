<div class="row">
    <a href="{{ route('profesor.curso.taller.tarifa.crear.post', ['tall_id' => $taller->tall_id,'curs_id'=>$taller->curs_id]) }}" class="btn btn-primary" >Crear tarifa para el taller </a>
</div>
<br>
<div class="row">
    <div class="col-xs-12">
        <table class="table" width="100%" id="tarifa-table" >
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Nombre</strong></td>
                    <td><strong>Valor</strong></td>
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
            $('#tarifa-table').DataTable({
                "dom"       : "lBfrtip",
                "buttons"   : ['reset', 'reload'],
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "lengthMenu": [5, 10, 25, 50, 75, 100],
                "ajax": "{{ route('profesor.curso.taller.tarifa.verajax',['curs_id' => $taller->curs_id,'tall_id'=>$taller->tall_id]) }}",
                "columns" : [
                    {data: 'tari_id', name: 'tari_id', width: '5%'},
                    {data: 'tari_nombre', name: 'tari_nombre', width: '50%'},
                    {data: 'tari_valor', name: 'tari_valor', width: '15%'},
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

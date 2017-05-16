<br>
<div class="row">
    <div  class="table-responsive" >
        <table class="table" id="usuario-table" >
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Nombre</strong></td>
                    <td><strong>Correo</strong></td>
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
            $('#usuario-table').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "lengthMenu": [5, 10, 25, 50, 75, 100],
                "ajax": "{{ route('profesor.curso.taller.usuarios',['tall_id' => $taller->tall_id,'curs_id'=>$taller->curs_id]) }}",
                "columns" : [
                    {data: 'id', name: 'id', width: '5%'},
                    {data: 'name', name: 'name', width: '50%'},
                    {data: 'email', name: 'email', width: '50%'},
                    {data: 'opciones', name: 'action', orderable: false, searchable: false, width: '30%'}
                ],
                "language" : {
                    "url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
                }
            });
        });
    </script>
@endpush

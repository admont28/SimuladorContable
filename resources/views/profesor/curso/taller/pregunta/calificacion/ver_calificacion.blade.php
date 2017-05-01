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
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('profesor.curso.taller.pregunta.respuesta.calificacion',['tall_id' => $taller->tall_id,'curs_id'=>$taller->curs_id]) }}",
                "columns" : [
                    {data: 'usua_id', name: 'usua_id', width: '5%'},
                    {data: 'usua_nombre', name: 'usua_nombre', width: '50%'},
                    {data: 'usua_correo', name: 'usua_correo', width: '50%'},
                    {data: 'opciones', name: 'action', orderable: false, searchable: false, width: '30%'}
                ],
                "language" : {
                    "url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
                }
            });
        });
    </script>
@endpush

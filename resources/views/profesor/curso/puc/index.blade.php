<div class="row">
    <a href="{{ route('profesor.curso.puc.crear', ['curs_id' => $curso->curs_id]) }}" class="btn btn-primary">Cargar nuevo archivo</a>
</div>
<br>
<div class="row">
    <div class="table-responsive">
        <table class="table" id="ver-puc">
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Código</strong></td>
                    <td><strong>Nombre</strong></td>
                </tr>
            </thead>
        </table>
    </div>
</div>
<br>
@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#ver-puc').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('profesor.curso.puc.verajax', ['curs_id' => $curso->curs_id]) }}",
                "columns" : [
                    {data: 'puc_id', name: 'puc_id', width: '5%'},
                    {data: 'puc_codigo', name: 'puc_codigo', width: '20%'},
                    {data: 'puc_nombre', name: 'puc_nombre', width: '75%'},
                ],
                "language" : {
                    "url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
                }
            });
        });
    </script>
@endpush

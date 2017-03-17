

<p>Bienvenido a la sección de talleres por favor escoja que desea hacer:</p>
<a href="{{ route('profesor.curso.creartaller',['curs_id' => $curso->curs_id]) }}" class="btn btn-primary" >Crear un taller</a>
<br>
<br>
<div class="row">
    <div  class="table-responsive" >
        <table class="table" id="taller-table" >
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>NOMBRE</strong></td>
                    <td><strong>TIPO</strong></td>
                    <td><strong>TIEMPO</strong></td>
                    <td><strong>OPCIONES</strong></td>
                </tr>
            </thead>

        </table>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(function() {
        $('#taller-table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('profesor.curso.taller.verajax',['curs_id' => $curso->curs_id]) }}",
            "columns" : [
                {data: 'tall_id', name: 'tall_id', width: '5%'},
                {data: 'tall_nombre', name: 'tall_nombre', width: '15%'},
                {data: 'tall_tipo', name: 'tall_tipo', width: '40%'},
                {data: 'tall_tiempo', name: 'tall_tiempo', width: '20%'},
                {data: 'opciones', name: 'action', orderable: false, searchable: false, width: '20%'}
            ],
            "language" : {
                "url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
            }
        });
    });
</script>

@endpush('scripts')

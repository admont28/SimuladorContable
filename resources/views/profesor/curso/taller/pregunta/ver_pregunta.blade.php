<div class="row">
        <a href="{{ route('profesor.curso.taller.pregunta.crear', ['tall_id' => $taller->tall_id,'curs_id'=>$taller->curs_id]) }}" class="btn btn-primary">Crear pregunta para el taller</a>
</div>
<br>
<div class="row">
    <div class="table-responsive">
        <table class="table" id="ver-materias">
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Texto</strong></td>
                    <td><strong>Tipo</strong></td>
                    <td><strong>Porcentaje</strong></td>
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
                {data: 'preg_id', name: 'preg_id', width: '5%'},
                {data: 'preg_texto', name: 'preg_texto', width: '15%'},
                {data: 'preg_tipo', name: 'preg_tipo', width: '40%'},
                {data: 'preg_porcentaje', name: 'preg_porcentaje', width: '20%'},
                {data: 'opciones', name: 'action', orderable: false, searchable: false, width: '20%'}
            ],
            "language" : {
                "url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
            }
        });
    });
</script>
@endpush

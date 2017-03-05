<div class="row">
        <a href="{{ route('profesor.curso.tema.crear', ['curs_id' => $curso->curs_id]) }}" class="btn btn-primary">Crear tema para el curso</a>
</div>
<br>
<div class="row">
    <div class="table-responsive">
        <table class="table" id="ver-temas">
            <thead>
                <tr>
                    <td><strong>ID</strong></td>
                    <td><strong>Título del tema</strong></td>
                    <td><strong>Ruta del archivo</strong></td>
                </tr>
            </thead>
        </table>
    </div>
</div>
<br>

@section('scripts')
<script type="text/javascript">
    $(function() {
        $('#ver-temas').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "{{ route('profesor.curso.tema.verajax', ['curs_id' => $curso->curs_id]) }}",
            "language" : {
                "url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
            }
        });
    });
</script>
@endsection

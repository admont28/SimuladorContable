<div class="row">
    <a href="{{ route('profesor.curso.puc.crear', ['curs_id' => $curso->curs_id]) }}" class="btn btn-primary">Cargar nuevo archivo</a>
    <a href="{{ route('profesor.curso.puc.comercial.crear', ['curs_id' => $curso->curs_id]) }}" class="btn btn-success" id="usar-puc-comercial">¿Usar el PUC Comercial?</a>
    <a href="{{ asset('storage/puccomercial/PUC-Archivo-Cargable.csv') }}" target="_blank" class="btn btn-default">Descargar PUC Comercial</a>
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
                "lengthMenu": [ 5, 10, 25, 50, 75, 100 ],
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
        $(document).ready(function() {
            $('#usar-puc-comercial').click(function(event) {
                event.preventDefault();
                swal({
                    title: '¿Está seguro de esta acción?',
                    text: "Al usar el PUC Comercial cargado en nuestras bases de datos por defecto se copiarán todos los datos al PUC del curso. Por favor confirme.",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, continuar',
                    cancelButtonText: 'No, cancelar'
                }).then(function (option) {
                    if(option === true){
                        window.location.href = '{{ route('profesor.curso.puc.comercial.crear', ['curs_id' => $curso->curs_id]) }}';
                        return true;
                    }else{
                        return false;
                    }
                })
            });
        });
    </script>
@endpush

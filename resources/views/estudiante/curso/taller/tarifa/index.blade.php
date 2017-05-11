<div class="row">
    <div class="col-xs-12">
        <table class="table" width="100%" id="tarifas-taller-{{ $tallerPractico->tall_id }}" >
            <thead>
                <tr>
                    <td><strong>Nombre</strong></td>
                    <td><strong>Valor</strong></td>
                </tr>
            </thead>
        </table>
    </div>
</div>
<br>

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $('#tarifas-taller-{{ $tallerPractico->tall_id }}').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "lengthMenu": [5, 10, 25, 50, 75, 100],
                "ajax": "{{ route('estudiante.curso.taller.tarifa.verajax',['curs_id' => $tallerPractico->curs_id,'tall_id'=>$tallerPractico->tall_id]) }}",
                "columns" : [
                    {data: 'tari_nombre', name: 'tari_nombre', width: '50%'},
                    {data: 'tari_valor', name: 'tari_valor', width: '50%'},
                ],
                "language" : {
                    "url" : "//cdn.datatables.net/plug-ins/1.10.12/i18n/Spanish.json"
                }
            });
        });
    </script>
@endpush

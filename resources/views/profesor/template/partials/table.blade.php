<div class="table-responsive">
    <table class="table table-striped table-hover table-bordered table-condensed">
        <thead>
            <tr>
                @foreach ($cabeceras as $cabecera)
                    <td>{{ $cabecera }}</td>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($filas as $fila)
                <tr>
                    @foreach ($nombres_atributos as $nombre_atributo)
                        <td>{{ $fila->$nombre_atributo }}</td>
                    @endforeach
                        <td>
                            @foreach ($opciones as $opcion)
                                @if ($opcion->id == $fila->getKey())
                                    {!! $opcion->valores !!}
                                    @break
                                @endif
                            @endforeach
                        </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>

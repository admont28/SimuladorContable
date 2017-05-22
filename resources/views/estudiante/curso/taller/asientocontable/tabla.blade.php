<br>
<div class="row">
    <table class="table table-striped table-bordered table-hover taller-asiento-contable" id="taller-asiento-contable-{{ $iteracion }}" data-iteracion="{{ $iteracion }}">
        <thead>
            <tr>
                <td colspan="5" class="text-center"><strong>TABLA {{ $iteracion }}</strong>
                    @if($tallerPractico->tallerAsientoContable->respuestasTallerAsientoContableUsuarioAutenticado($iteracion)->isEmpty())
                        <span id="label-tabla-{{ $iteracion }}" class="label label-danger">TABLA SIN GUARDAR</span>
                    @else
                        <span id="label-tabla-{{ $iteracion }}" class="label label-success">TABLA GUARDADA</span>
                    @endif
                    </td>
            </tr>
            <tr>
                <td class="text-center" width="20%"><strong>CÓDIGO</strong></td>
                <td class="text-center" width="20%"><strong>CUENTAS</strong></td>
                <td class="text-center" width="25%"><strong>DÉBITO</strong></td>
                <td class="text-center" width="25%"><strong>CRÉDITO</strong></td>
                <td class="text-center" width="10%"><strong>OPCIÓN</strong></td>
            </tr>
        </thead>
        <tbody>
            @if($tallerPractico->tallerAsientoContable->respuestasTallerAsientoContableUsuarioAutenticado($iteracion)->isEmpty())
                @for ($i = 0; $i < 2; $i++)
                    <tr>
                        <td class="text-center vcenter" width="20%">
                            <select class="form-control selectpicker columna_codigo with-ajax" data-live-search="true">
                            </select>
                        </td>
                        <td class="text-center vcenter columna_cuentas" width="20%"></td>
                        <td class="text-center vcenter columna_debito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar." data-valor-antiguo="0">$ 0</td>
                        <td class="text-center vcenter columna_credito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar." data-valor-antiguo="0">$ 0</td>
                        <td class="text-center vcenter columna_opcion" width="10%"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                    </tr>
                @endfor
                <tr id="sumas-iguales">
                    <td colspan="2" class="text-center"><strong>SUMAS IGUALES</strong></td>
                    <td class="text-center total_debito" id="total_debito">$ 0</td>
                    <td class="text-center total_credito" id="total_credito">$ 0</td>
                    <td class="text-center"></td>
                </tr>
            @else
                @foreach ($tallerPractico->tallerAsientoContable->respuestasTallerAsientoContableUsuarioAutenticado($iteracion)->first()->filasTallerAsientoContable as $ftac)
                    <tr>
                        <td class="text-center vcenter" width="20%">
                            <select class="form-control selectpicker columna_codigo with-ajax" data-live-search="true">
                                <option value="{{ $ftac->puc_id }}" data-subtext="{{ $ftac->puc->puc_nombre }}" selected="selected">{{ $ftac->puc->puc_codigo }}</option>
                            </select>
                        </td>
                        <td class="text-center vcenter columna_cuentas" width="20%">{{ $ftac->puc->puc_nombre }}</td>
                        <td class="text-center vcenter columna_debito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar." data-valor-antiguo="{{ $ftac->ftac_valordebito }}">{{ $ftac->ftac_valordebito }}</td>
                        <td class="text-center vcenter columna_credito" contenteditable="true" width="25%" data-toggle="tooltip" title="Presiona clic para editar." data-valor-antiguo="{{ $ftac->ftac_valorcredito }}">{{ $ftac->ftac_valorcredito }}</td>
                        <td class="text-center vcenter columna_opcion" width="10%"><button class="btn btn-xs btn-danger eliminar-fila" ><i class="glyphicon glyphicon-trash"></i> Eliminar</button></td>
                    </tr>
                @endforeach
                <tr id="sumas-iguales">
                    <td colspan="2" class="text-center"><strong>SUMAS IGUALES</strong></td>
                    <td class="text-center total_debito" id="total_debito">{{ $tallerPractico->tallerAsientoContable->respuestasTallerAsientoContableUsuarioAutenticado($iteracion)->first()->calcularTotalDebito() }}</td>
                    <td class="text-center total_credito" id="total_credito">{{ $tallerPractico->tallerAsientoContable->respuestasTallerAsientoContableUsuarioAutenticado($iteracion)->first()->calcularTotalCredito() }}</td>
                    <td class="text-center"></td>
                </tr>
            @endif
        </tbody>
    </table>
</div>
<div class="row">
    <div class="col-lg-12 text-center">
        <button class="btn btn-default adicionar-fila-asiento-contable" id="adicionar-fila-asiento-contable" data-iteracion="{{ $iteracion }}">Adicionar fila</button>
        <button class="btn btn-primary solucionar-taller-asiento-contable" id="solucionar-taller-asiento-contable" data-ruta="{{ route('estudiante.curso.taller.solucionar.asientocontable.post', ['curs_id' => $curso->curs_id, 'tall_id' => $tallerPractico->tall_id, 'numeroTabla' => ($iteracion)]) }}" data-iteracion="{{ $iteracion }}">Guardar tabla</button>
    </div>
</div>
<br>

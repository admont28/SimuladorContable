@extends('profesor.template.main')

@section('title-head', 'Respuesta de taller de asientos contables')

@section('title')
    {!! 'Taller de asientos contables - Respuesta del usuario: <strong>'.$usuario->name.'</strong>' !!}
@endsection

@section('active','#profesor-curso')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Respuesta del usuario - Tabla de asientos contables</h3>
                </div>
                <div class="panel-body">
                    @foreach ($respuestasTallerAsientosContables as $rtac)
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover taller-asiento-contable" id="taller-asiento-contable-{{ $loop->iteration }}" data-iteracion="{{ $loop->iteration }}">
                                    <thead>
                                        <tr>
                                            <td colspan="5" class="text-center"><strong>TABLA {{ $loop->iteration }}</strong></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center" width="15%"><strong>CÓDIGO</strong></td>
                                            <td class="text-center" width="45%"><strong>CUENTAS</strong></td>
                                            <td class="text-center" width="20%"><strong>DÉBITO</strong></td>
                                            <td class="text-center" width="20%"><strong>CRÉDITO</strong></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rtac->filasTallerAsientoContable as $ftac)
                                            <tr>
                                                <td class="text-center vcenter columna_codigo" width="10%">{{ $ftac->puc->puc_codigo }}</td>
                                                <td class="text-center vcenter columna_cuentas" width="40%">{{ $ftac->puc->puc_nombre }}</td>
                                                <td class="text-center vcenter columna_debito formato_pesos" width="20%">{{ $ftac->ftac_valordebito }}</td>
                                                <td class="text-center vcenter columna_credito formato_pesos" width="20%">{{ $ftac->ftac_valorcredito }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="2" class="text-center"><strong>SUMAS IGUALES</strong></td>
                                            <td class="text-center total_debito formato_pesos">{{ $rtac->calcularTotalDebito() }}</td>
                                            <td class="text-center total_credito formato_pesos">{{ $rtac->calcularTotalCredito() }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12 text-center">
            <a href="{{ route('profesor.curso.taller.ver', ['curs_id' => $curso->curs_id, 'tall_id' => $taller->tall_id]) }}" class="btn btn-default">Regresar</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".taller-asiento-contable > tbody > tr > td").each(function(index, el) {
                if ($(el).hasClass('formato_pesos')) {
                    $(el).text(numeral($(el).text()).format('$0,0'));
                }
            });
        });
    </script>
@endpush

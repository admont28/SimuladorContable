@extends('general.template.main')

@section('title', 'Información')

@section('content')
    <div class="col-md-12">
        <div class="col-md-5">
            <img src="{{ asset('images/mujer-senala.jpg') }}" alt="Mujer Señala" class="img-responsive">
        </div>
        <div class="col-md-7 text-justify">
            <p class="text-justify lead">
                Los temas a tratar en el laboratorio contable  1 son:
            </p>
            <br>
            <table class="table table-striped table-bordered table-hover">
                <tbody>
                    <tr>
                        <td class="vcenter text-center"><strong>Contabilidad I</strong></td>
                        <td class="vcenter text-center">Fundamentos de sistemas de información contable.</td>
                    </tr>
                    <tr>
                        <td rowspan="4" class="vcenter text-center"><strong>Contabilidad II</strong></td>
                    </tr>
                    <tr>
                        <td class="vcenter text-center">Nómina</td>
                    </tr>
                    <tr>
                        <td class="vcenter text-center">Kardex</td>
                    </tr>
                    <tr>
                        <td class="vcenter text-center">Estados financieros NIIF</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

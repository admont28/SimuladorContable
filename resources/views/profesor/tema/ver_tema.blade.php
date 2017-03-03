@extends('profesor.template.main')

@section('title','Sección de temas')

@section('active','#profesor-curso')

@section('content')

    <table class="table">
        <tr>
            <td>id:</td>
            <td>Titulo </td>
            <td>curso</td>

        </tr>
        <tr>
            @foreach ($tema as $tema )
                <tr>
                    <td>{{ $tema->tema_id }}</td>
                    <td>{{ $tema->tema_titulo }}</td>
                    <td>{{ $tema->curs_id }}</td>
                </tr>


            @endforeach
        </tr>




    </table>

@endsection

@section('scripts')

@endsection

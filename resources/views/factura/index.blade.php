@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        @if ($compras_sin_facturar == 0)
         <button class="btn btn-success btn-sm" disabled type="button">Sin Compras</button>
        @else
        <a href="{{ route("factura.facturar") }}" class="btn btn-success btn-sm">Facturar {{ $compras_sin_facturar }} compras</a>
        @endif


        <div class="text-center">
            <h1>Facturacion</h1>
        </div>


        @if (session('message'))
            <div class="my-4 alert alert-success" role="alert">
                {{session('message')}}
            </div>
        @endif

        <div class="mt-4">

            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Numero De Factura</th>
                        <th>Cliente</th>
                        {{-- <th>Cantida De Productos</th> --}}
                        <th>Botones</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($facturas as $i => $factura)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $factura->id }}</td>
                            <td>{{ $factura->cliente->name }}</td>
                            {{-- <td>{{ $factura->compras->w->count() }}</td> --}}
                            <td>
                                <a href="{{ route("factura.show", ["factura" => $factura->id]) }}" class="btn btn-primary btn-sm">Ver</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>


            </table>

        </div>

    </div>
@endsection

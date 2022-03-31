@extends('layouts.app')

@section('content')
    <div class="container mt-4">

            <a href="{{ route("factura.index") }}" class="btn btn-success btn-sm">volver</a>


        <div class="text-center">
            <h1>Factura N' {{ $factura->id }} Para Cliente {{ $factura->cliente->name }}</h1>
        </div>


        @if (session('message'))
            <div class="my-4 alert alert-success" role="alert">
                {{session('message')}}
            </div>
        @endif

        <div class="mt-4">

                        @php
                            $total_precio = 0;
                            $total_impuesto = 0;
                            $total_precio_impuesto = 0;
                        @endphp
            <table class="table table-light">
                <thead class="thead-light">
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        {{-- <th>cliente</th> --}}
                        <th>precio</th>
                        <th>% impuesto</th>
                        <th>Precio Con Impuesto</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($factura->compras as $i => $compra)
                        @php
                        $precio_sin_impuesto = $compra->producto->precio_con_impuesto * ((100 - $compra->producto->procentaje_impuesto) * 0.01);

                            $total_precio += $precio_sin_impuesto;
                            $total_impuesto += $compra->producto->procentaje_impuesto;
                            $total_precio_impuesto += $compra->producto->precio_con_impuesto;
                        @endphp

                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $compra->producto->nombre }}</td>
                            {{-- <td>{{ $compra->factura[0]->cliente->name }}</td> --}}
                            <td>{{ $precio_sin_impuesto }}</td>
                            <td>{{ $compra->producto->procentaje_impuesto }}</td>
                            <td>{{ $compra->producto->precio_con_impuesto  }}</td>
                            {{-- <td>{{ $compra->compras->count() }}</td> --}}
                        </tr>
                    @endforeach

                </tbody>

                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>{{$total_precio}}</th>
                        <th>{{$total_impuesto}}</th>
                        <th>{{$total_precio_impuesto}}</th>
                    </tr>
                </tfoot>
            </table>

        </div>

    </div>
@endsection

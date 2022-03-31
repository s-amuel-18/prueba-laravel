@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        @if (auth()->user()->rol == "admin")
            <a href="{{ route("producto.create") }}" class="btn btn-success btn-sm">Crear Producto</a>
        @endif

        <div class="text-center">
            <h1>Lista De Productos</h1>
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
                        <th>Nombre</th>
                        <th>Precio (Impuesto Incluido)</th>
                        <th>Botones</th>
                    </tr>
                </thead>

                @foreach ($productos as $i => $producto)
                    <tbody>
                        <tr>
                            <td> {{ $i + 1 }} </td>
                            <td> {{ $producto->nombre }} </td>
                            <td> {{ $producto->precio_con_impuesto }} </td>
                            <td>
                                <form action="{{ route('producto.compra', ['producto' => $producto->id]) }}" class="d-inline"
                                    method="POST">
                                    @csrf

                                    <button class="btn btn-warning btn-sm" type="submit">Comprar</button>
                                </form>

                                @if ( auth()->user()->rol ==  "admin" )
                                    <a href="{{ route("producto.edit", ["producto" => $producto->id]) }}" class="btn btn-success btn-sm">Editar</a>

                                    <form class="d-inline" action="{{ route("producto.destroy", ["producto" => $producto->id]) }}" method="POST">
                                        @csrf
                                        @method("DELETE")

                                        <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                    </form>

                                @endif
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>

            <div class="d-flex justify-content-center">
                {{ $productos->links() }}
            </div>
        </div>

    </div>
@endsection

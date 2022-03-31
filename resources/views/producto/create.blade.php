@extends('layouts.app')

@section('content')
    <div class="container mt-4">

        <div class="text-center">
            <h1>Crear Producto</h1>
        </div>

        <div class="">
            <form action="{{ route('producto.store') }}" method="POST">

                @csrf

                <div class="row">
                    <div class="col-md-3">
                        {{-- nombre del producto --}}
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input id="nombre" class="form-control @error('nombre') is-invalid @enderror" type="text" name="nombre" value="{{ old("nombre") }}">

                            @error('nombre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        {{-- precio_con_impuesto --}}
                        <div class="form-group">
                            <label for="precio_con_impuesto">Pecio Con Impuesto</label>
                            <input id="precio_con_impuesto" min="0" class="form-control @error('precio_con_impuesto') is-invalid @enderror" type="number"
                                name="precio_con_impuesto" value="{{ old("precio_con_impuesto") }}">

                            @error('precio_con_impuesto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>

                    <div class="col-md-3">
                        {{-- procentaje_impuesto --}}
                        <div class="form-group">
                            <label for="procentaje_impuesto">% Impuesto</label>
                            <input id="procentaje_impuesto" min="0" class="form-control @error('procentaje_impuesto') is-invalid @enderror" type="number"
                                name="procentaje_impuesto" value="{{ old("procentaje_impuesto") }}">

                            @error('procentaje_impuesto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-block btn-primary" type="submit">Registrar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

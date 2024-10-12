@extends('template')

@section('title', 'Ver Compra')

@push('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Ver Compra</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('compras.index') }}">Compras</a></li>
            <li class="breadcrumb-item active">Ver Compra</li>
        </ol>
    </div>
    <div class="container w-100">

        <div class="card p-2 mb-4">
            <!-- Tipo comprobante -->
            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-file"></i></span>
                        <input type="text" disabled class="form-control" value="Tipo de comprobante">
                    </div>
                </div>
                <div class="col-md-8">
                    <input type="text" disabled class="form-control"
                        value="{{ $compra->comprobante->tipo_comprobante }}">
                </div>
            </div>

            <!-- Numero comprobante -->
            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-hashtag"></i></span>
                        <input type="text" disabled class="form-control" value="Numero de comprobante">
                    </div>
                </div>
                <div class="col-md-8">
                    <input type="text" disabled class="form-control" value="{{ $compra->numero_comprobante }}">
                </div>
            </div>

            <!-- Proveedor -->
            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-user-tie"></i></span>
                        <input type="text" disabled class="form-control" value="Proveedor">
                    </div>
                </div>
                <div class="col-md-8">
                    <input type="text" disabled class="form-control"
                        value="{{ $compra->proveedore->persona->razon_social }}">
                </div>
            </div>

            <!-- Fecha -->
            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-calendar-days"></i></span>
                        <input type="text" disabled class="form-control" value="Fecha">
                    </div>
                </div>
                <div class="col-md-8">
                    <input type="text" disabled class="form-control"
                        value="{{ \Carbon\Carbon::parse($compra->fecha_hora)->format('d-m-Y') }}">
                </div>
            </div>

            <!-- Hora -->
            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-clock"></i></span>
                        <input type="text" disabled class="form-control" value="Hora">
                    </div>
                </div>
                <div class="col-md-8">
                    <input type="text" disabled class="form-control"
                        value="{{ \Carbon\Carbon::parse($compra->fecha_hora)->format('H:i') }}">
                </div>
            </div>

            <!-- Impuesto -->
            <div class="row mb-2">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="fa-solid fa-percent"></i></span>
                        <input type="text" disabled class="form-control" value="Impuesto">
                    </div>
                </div>
                <div class="col-md-8">
                    <input id="input-impuesto" type="text" disabled class="form-control" value="{{ $compra->impuesto }}">
                </div>
            </div>
        </div>

        <!-- Tabla -->
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla de detalles de compra
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped">
                    <thead class="bg-primary">
                        <tr class="align-top">
                            <th class="text-white">Producto</th>
                            <th class="text-white">Cantidad</th>
                            <th class="text-white">Precio de compra</th>
                            <th class="text-white">Precio de venta</th>
                            <th class="text-white">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compra->productos as $producto)
                            <tr>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->pivot->cantidad }}</td>
                                <td>{{ $producto->pivot->precio_compra }}</td>
                                <td>{{ $producto->pivot->precio_venta }}</td>
                                <td class="td-subtotal">{{ $producto->pivot->cantidad * $producto->pivot->precio_compra }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5"></th>
                        </tr>
                        <tr>
                            <th colspan="4">Sumas</th>
                            <th id="th-suma"></th>
                        </tr>
                        <tr>
                            <th colspan="4">IGV</th>
                            <th id="th-igv"></th>
                        </tr>
                        <tr>
                            <th colspan="4">Total</th>
                            <th id="th-total"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script>
        //Variables
        let filasSubtotal = document.getElementsByClassName('td-subtotal');
        let cont = 0;
        let impuesto = $('#input-impuesto').val();

        $(document).ready(function() {
            calcularValores();
        });

        function calcularValores() {
            for (let i = 0; i < filasSubtotal.length; i++) {
                cont += parseFloat(filasSubtotal[i].innerHTML);
            }

            $('#th-suma').html(cont);
            $('#th-igv').html(impuesto);
            $('#th-total').html(round(cont + parseFloat(impuesto)));
        }

        function round(num, decimales = 2) {
            var signo = (num >= 0 ? 1 : -1);
            num = num * signo;
            if (decimales === 0) //con 0 decimales
                return signo * Math.round(num);
            // round(x * 10 ^ decimales)
            num = num.toString().split('e');
            num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));
            // x * 10 ^ (-decimales)
            num = num.toString().split('e');
            return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
        }
        //Fuente: https://es.stackoverflow.com/questions/48958/redondear-a-dos-decimales-cuando-sea-necesario
    </script>
@endpush

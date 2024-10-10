@extends('template')

@section('title', 'Crear compra')

@push('css')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Crear Compra</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ route('compras.index') }}">Compra</a></li>
            <li class="breadcrumb-item active">Crear Compra</li>
        </ol>
        <form action="" method="post">
            @csrf
            <div class="container mt-4">
                <div class="row gy-4">
                    <!-- Compra producto -->
                    <div class="col-md-8">
                        <div class="text-white bg-primary p-1 text-center">
                            Detalles de producto
                        </div>
                        <div class="p-3 border border-3 border-primary">
                            <div class="row">
                                <!-- Producto -->
                                <div class="col-md-12 mb-2">
                                    <select name="producto_id" id="producto_id" class="form-control selectpicker"
                                        data-live-search="true" data-size="5" title="Selecciona un producto">
                                        @foreach ($productos as $producto)
                                            <option value="{{ $producto->id }}">
                                                {{ $producto->codigo . ' ' . $producto->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Cantidad -->
                                <div class="col-md-4 mb-2">
                                    <label for="cantidad" class="form-label">Cantidad</label>
                                    <input type="number" name="cantidad" id="cantidad" class="form-control">
                                </div>
                                <!-- Precio de compra -->
                                <div class="col-md-4 mb-2">
                                    <label for="precio_compra" class="form-label">Precio de compra</label>
                                    <input type="number" name="precio_compra" id="precio_compra" class="form-control"
                                        step="0.1">
                                </div>
                                <!-- Precio de venta -->
                                <div class="col-md-4 mb-2">
                                    <label for="precio_venta" class="form-label">Precio de venta</label>
                                    <input type="number" name="precio_venta" id="precio_venta" class="form-control"
                                        step="0.1">
                                </div>
                                <!-- Boton para guardar -->
                                <div class="col-md-12 text-end mb-2">
                                    <button type="button" id="btn_agregar" class="btn btn-primary">Agregar</button>
                                </div>
                                <!-- Tabla para el detalle de la compra -->
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="tabla_detalle" class="table table-hover table-striped">
                                            <thead class="bg-primary text-white">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Producto</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio compra</th>
                                                    <th>Precio venta</th>
                                                    <th>Subtotal</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th></th>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th></th>
                                                    <th>Sumas</th>
                                                    <th>0</th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th>IGV %</th>
                                                    <th>0</th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th>Total</th>
                                                    <th>0</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Producto -->
                    <div class="col-md-4">
                        <div class="text-white bg-success p-1 text-center">
                            Datos generales
                        </div>
                        <div class="p-3 border border-3 border-success">
                            <div class="row">
                                <!-- Proveedor -->
                                <div class="col-md-12">
                                    <label for="proveedore_id" class="form-label">Proveedor</label>
                                    <select name="proveedore_id" id="proveedore_id"
                                        class="form-control selectpicker show-tick" data-live-search="true"
                                        title="Selecciona" data-size="6">
                                        @foreach ($proveedores as $proveedor)
                                            <option value="{{ $proveedor->id }}">{{ $proveedor->persona->razon_social }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tipo de comprobante -->
                                <div class="col-md-12 mb-2">
                                    <label for="comprobante_id" class="form-label">Comprobante</label>
                                    <select name="comprobante_id" id="comprobante_id"
                                        class="form-control selectpicker show-tick" data-live-search="true"
                                        title="Selecciona" data-size="6">
                                        @foreach ($comprobantes as $comprobante)
                                            <option value="{{ $comprobante->id }}">{{ $comprobante->tipo_comprobante }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Numero de comprobante -->
                                <div class="col-md-12 mb-2">
                                    <label for="numero_comprobante" class="form-label">Comprobante</label>
                                    <input type="text" name="numero_comprobante" id="numero_comprobante"
                                        class="form-control" required>
                                </div>

                                <!-- Impuesto -->
                                <div class="col-md-6 mb-2">
                                    <label for="impuesto" class="form-label">Impuesto</label>
                                    <input type="text" name="impuesto" id="impuesto" class="form-control border-success"
                                        readonly>
                                </div>

                                <!-- Fecha -->
                                <div class="col-md-6 mb-2">
                                    <label for="fecha" class="form-label">Fecha</label>
                                    <input type="date" name="fecha" id="fecha"
                                        class="form-control border-success" value="<?php echo date('Y-m-d'); ?>" readonly>
                                </div>

                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success">Guardar</button>
                                    <button id="mauro" class="btn btn-success" type="button">Tocame</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#btn_agregar').click(function() {
                agregarProducto();
            });
        });


        // Variables
        let cont = 0;
        let subtotal = [];

        function agregarProducto() {
            let idProducto = $('#producto_id').val();
            let nameProducto = ($('#producto_id option:selected').text()).split(' ')[1];
            let cantidad = $('#cantidad').val();
            let precioCompra = $('#precio_compra').val();
            let precioVenta = $('#precio_venta').val();


            // Calcular valores
            subtotal[cont] = cantidad * precioCompra;


            let fila = '<tr>' +
                '<th>' + (cont + 1) + '</th>' +
                '<td>' + nameProducto + '</td>' +
                '<td>' + cantidad + '</td>' +
                '<td>' + precioCompra + '</td>' +
                '<td>' + precioVenta + '</td>' +
                '<td>' + subtotal[cont] + '</td>' +
                '<td><button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></td>' +
                '</tr>';
            $('#tabla_detalle').append(fila);
        }
    </script>
@endpush

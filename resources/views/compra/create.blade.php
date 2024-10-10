@extends('template')

@section('title', 'Crear compra')

@push('css')
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                                    <th colspan="4">Sumas</th>
                                                    <th colspan="2"><span id="sumas">0</span></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th colspan="4">IGV %</th>
                                                    <th colspan="2"><span id="igv">0</span></th>
                                                </tr>
                                                <tr>
                                                    <th></th>
                                                    <th colspan="4">Total</th>
                                                    <th colspan="2"><span id="total">0</span></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <!-- Boton para cancelar compra -->
                                <div class="col-md-12 mb-2">
                                    <button type="button" id="cancelar" class="btn btn-danger" data-bs-target="#cancelarModal">Cancelar
                                        compra</button>
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
                                    <input type="text" name="impuesto" id="impuesto"
                                        class="form-control border-success" readonly>
                                </div>

                                <!-- Fecha -->
                                <div class="col-md-6 mb-2">
                                    <label for="fecha" class="form-label">Fecha</label>
                                    <input type="date" name="fecha" id="fecha"
                                        class="form-control border-success" value="<?php echo date('Y-m-d'); ?>" readonly>
                                </div>

                                <!-- Boton guardar compra -->
                                <div class="col-md-12 text-center">
                                    <button type="submit" id="guardar" class="btn btn-success">Guardar</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="cancelarModal-{{ $producto->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal de confirmación</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Seguro que quieres cancelar tu compra?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button id="btnCancelarCompra" type="button" class="btn btn-danger"
                                data-bs-dismiss="modal">Confirmar</button>
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

            $('#btnCancelarCompra').click(function() {
                cancelarCompra();
            });

            disableButtons();

            $('#impuesto').val(impuesto + '%');

        });


        // Variables
        let cont = 0;
        let subtotal = [];
        let sumas = 0;
        let igv = 0;
        let total = 0;

        // Constantes
        const impuesto = 18;

        function cancelarCompra() {
            $('#tabla_detalle > tbody').empty();
            let fila =
                '<tr>' +
                '<th></th>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '<td></td>' +
                '</tr>';
            $('#tabla_detalle').append(fila);

            // Reiniciar los valores de las variables
            cont = 0;
            subtotal = [];
            sumas = 0;
            igv = 0;
            total = 0;

            //Mostrar los campos calculados
            $('#sumas').html(sumas);
            $('#igv').html(igv);
            $('#total').html(total);

            limpiarCampos();
            disableButtons();

        }

        function disableButtons(){
            if (total == 0){
                $('#guardar').hide();
                $('#cancelar').hide();
            }else{
                $('#guardar').show();
                $('#cancelar').show();
            }
        }


        function agregarProducto() {
            let idProducto = $('#producto_id').val();
            let nameProducto = ($('#producto_id option:selected').text()).split(' ')[1];
            let cantidad = $('#cantidad').val();
            let precioCompra = $('#precio_compra').val();
            let precioVenta = $('#precio_venta').val();

            //Validaciones 
            //1.Para que los campos no esten vacíos
            if (idProducto != '' && cantidad != '') {

                //2. Para que los valores ingresados sean los correctos
                if (parseInt(cantidad) > 0 && (cantidad % 1 == 0) && parseFloat(descuento) >= 0) {

                    //3. Para que la cantidad no supere el stock
                    if (parseInt(cantidad) <= parseInt(stock)) {
                        //Calcular valores
                        subtotal[cont] = round(cantidad * precioVenta - descuento);
                        sumas += subtotal[cont];
                        igv = round(sumas / 100 * impuesto);
                        total = round(sumas + igv);

                        //Crear la fila
                        let fila = '<tr id="fila' + cont + '">' +
                            '<th>' + (cont + 1) + '</th>' +
                            '<td><input type="hidden" name="arrayidproducto[]" value="' + idProducto + '">' + nameProducto +
                            '</td>' +
                            '<td><input type="hidden" name="arraycantidad[]" value="' + cantidad + '">' + cantidad +
                            '</td>' +
                            '<td><input type="hidden" name="arrayprecioventa[]" value="' + precioVenta + '">' +
                            precioVenta + '</td>' +
                            '<td><input type="hidden" name="arraydescuento[]" value="' + descuento + '">' + descuento +
                            '</td>' +
                            '<td>' + subtotal[cont] + '</td>' +
                            '<td><button class="btn btn-danger" type="button" onClick="eliminarProducto(' + cont +
                            ')"><i class="fa-solid fa-trash"></i></button></td>' +
                            '</tr>';

                        //Acciones después de añadir la fila
                        $('#tabla_detalle').append(fila);
                        limpiarCampos();
                        cont++;
                        disableButtons();

                        //Mostrar los campos calculados
                        $('#sumas').html(sumas);
                        $('#igv').html(igv);
                        $('#total').html(total);
                        $('#impuesto').val(igv);
                        $('#inputTotal').val(total);
                    } else {
                        showModal('Cantidad incorrecta');
                    }

                } else {
                    showModal('Valores incorrectos');
                }

            } else {
                showModal('Le faltan campos por llenar');
            }
        }

        function eliminarProducto(indice) {
            //Calcular valores
            sumas -= round(subtotal[indice]);
            igv = round(sumas / 100 * impuesto);
            total = round(sumas + igv);

            //Mostrar los campos calculados
            $('#sumas').html(sumas);
            $('#igv').html(igv);
            $('#total').html(total);
            $('#impuesto').val(igv);
            $('#InputTotal').val(total);

            //Eliminar el fila de la tabla
            $('#fila' + indice).remove();

            disableButtons();
        }

        function limpiarCampos() {
            let select = $('#producto_id');
            select.selectpicker('val', '');
            $('#cantidad').val('');
            $('#precio_compra').val('');
            $('#precio_venta').val('');
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

        function showModal(message, icon = 'error') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: icon,
                title: message
            })
        }
    </script>
@endpush

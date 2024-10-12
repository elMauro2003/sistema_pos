@extends('template')

@section('title', 'Compras')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @if (session('success'))
        <script>
            let message = "{{ session('success') }}"
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: message
            });
        </script>
    @endif

    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Compras</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Marcas</li>
        </ol>

        <div class="row mb-4">
            <a href="{{ route('compras.create') }}">
                <button type="button" class="btn btn-primary">Añadir nuevo registro</button>
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla compras
            </div>
            <div class="card-body">
                <table class="table table-striped" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Comprobante</th>
                            <th>Proveedor</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compras as $compra)
                            <tr>
                                <td>
                                    <p class="fw-semibold mb-1">{{$compra->comprobante->tipo_comprobante}}</p>
                                    <p class="text-muted mb-0">{{$compra->numero_comprobante}}</p>
                                </td>
                                <td>
                                    <p class="fw-semibold mb-1">{{ucfirst($compra->proveedore->persona->tipo_persona)}}</p>
                                    <p class="text-muted mb-0">{{$compra->proveedore->persona->razon_social}}</p>
                                </td>
                                <td>
                                    {{
                                        \Carbon\Carbon::parse($compra->fecha_hora)->format('d-m-Y') .' | '.
                                        \Carbon\Carbon::parse($compra->fecha_hora)->format('H:i')
                                    }}
                                </td>
                                <td>
                                    {{$compra->total}}
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <button type="button" class="btn btn-success">Ver</button>
                                        <button type="button" class="btn btn-danger">Eliminar</button>
                                      </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="{{ asset('js/datatables-simple-demo.js') }}"></script>
@endpush

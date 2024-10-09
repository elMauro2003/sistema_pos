@extends('template')

@section('title', 'Productos')

@push('css-datatable')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
@endpush

@push('css')
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
        <h1 class="mt-4 text-center">Productos</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Productos</li>
        </ol>

        <div class="row mb-4">
            <a href="{{ route('productos.create') }}">
                <button type="button" class="btn btn-primary">Agregar nuevo registro</button>
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla categorías
            </div>
            <div class="card-body">
                <table class="table table-striped text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Marca</th>
                            <th>Presentaciones</th>
                            <th>Categorías</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                            <tr>
                                <td>
                                    {{ $producto->codigo }}
                                </td>
                                <td>
                                    {{ $producto->nombre }}
                                </td>
                                <td>
                                    {{ $producto->marca->caracteristica->nombre }}
                                </td>
                                <td>
                                    {{ $producto->presentacione->caracteristica->nombre }}
                                </td>
                                <td>
                                    @foreach ($producto->categorias as $categoria)
                                        <div class="container">
                                            <div class="row">
                                                <span class="m-1 rounded-pill p-1 bg-secondary text-white text-center">{{ $categoria->caracteristica->nombre }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    @if ($producto->estado == 1)
                                        <span class="fw-bolder p-1 rounded bg-success text-white"> ACTIVO </span>
                                    @else
                                        <span class="fw-bolder p-1 rounded bg-danger text-white"> INACTIVO </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <form action="{{ route('productos.edit', ['producto' => $producto]) }}"
                                            method="get">
                                            <button type="submit" class="btn btn-warning">Editar</button>
                                        </form>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#verModal-{{$producto->id}}">Ver</button>
                                        @if ($producto->estado == 1)
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$producto->id}}">Eliminar</button>
                                        @else
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $producto->id }}">Restaurar</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="verModal-{{$producto->id}}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Detalle de producto</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row mb-3">
                                                <label for="">Descripcion: <span class="fw-bolder">{{$producto->descripcion}}</span></label>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="">Fecha Vencimiento: <span class="fw-bolder">{{$producto->fecha_vencimiento == '' ? 'No tiene' : $producto->fecha_vencimiento}}</span></label>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="">Stock: <span class="fw-bolder">{{$producto->stock}}</span></label>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="">Image:</label>
                                                <div>
                                                    @if ($producto->img_path != null)
                                                        <img src="{{ Storage::url('app/public/productos/'.$producto->img_path) }}" class="img-fluid border border-4 rounded img-thumbnail" alt="{{$producto->nombre}}">
                                                    @else
                                                        <img src="" alt="{{$producto->nombre}}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal de Confirmacion -->
                            <div class="modal fade" id="confirmModal-{{$producto->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        {{$producto->estado == 1 ? '¿Seguro que deseas eliminar este producto?' : '¿Seguro que deseas restaurar este producto?'}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{route('productos.destroy',['producto'=>$producto->id])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Confirmar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

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

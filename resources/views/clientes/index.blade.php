@extends('template')

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
        <h1 class="mt-4 text-center">Clientes</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Clientes</li>
        </ol>
        <div class="row mb-4">
            <a href="{{ route('clientes.create') }}">
                <button type="button" class="btn btn-primary">Agregar nuevo registro</button>
            </a>
        </div>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla clientes
            </div>
            <div class="card-body">
                <table class="table table-striped text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Documento</th>
                            <th>Tipo de Persona</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <td>
                                    {{$cliente->persona->razon_social}}
                                </td>
                                <td>
                                    {{$cliente->persona->direccion}}
                                </td>
                                <td>
                                    {{$cliente->persona->documento->tipo_documento}}
                                </td>
                                <td>
                                    {{$cliente->persona->tipo_persona}}
                                </td>
                                <td>
                                    @if ($cliente->persona->estado == 1)
                                        <span class="badge rounded-pill text-bg-success d-inline"> ACTIVO </span>
                                    @else
                                        <span class="badge rounded-pill text-bg-danger d-inline"> INACTIVO </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <form action="{{ route('clientes.edit', ['cliente' => $cliente]) }}"
                                            method="get">
                                            <button type="submit" class="btn btn-warning">Editar</button>
                                        </form>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#verModal-{{$cliente->id}}">Ver</button>
                                        @if ($cliente->persona->estado == 1)
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$cliente->id}}">Eliminar</button>
                                        @else
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$cliente->id}}">Restaurar</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal de Confirmacion -->
                            <div class="modal fade" id="confirmModal-{{$cliente->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        {{$cliente->persona->estado == 1 ? '¿Seguro que deseas eliminar este cliente?' : '¿Seguro que deseas restaurar este cliente?'}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{route('clientes.destroy',['cliente'=>$cliente->persona->id])}}" method="post">
                                                @method('DELETE')
                                                @csrf
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
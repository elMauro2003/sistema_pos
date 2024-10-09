@extends('template')

@section('title', 'Proveedores')

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
        <h1 class="mt-4 text-center">Proveedores</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Proveedores</li>
        </ol>

        <div class="mb-4">
            <a href="{{ route('proveedores.create') }}">
                <button type="button" class="btn btn-primary">Añadir nuevo registro</button>
            </a>
        </div>

        <div class="card">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Tabla proveedores
            </div>
            <div class="card-body">
                <table class="table table-striped text-center" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Dirección</th>
                            <th>Documento</th>
                            <th>Tipo de persona</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($proveedores as $proveedor)
                            <tr>
                                <td>
                                    {{ $proveedor->persona->razon_social }}
                                </td>
                                <td>
                                    {{ $proveedor->persona->direccion }}
                                </td>
                                <td>
                                    <p class="fw-semibold mb-1">{{ $proveedor->persona->documento->tipo_documento }}</p>
                                    <p class="text-muted mb-0">{{ $proveedor->persona->numero_documento }}</p>
                                </td>
                                <td>
                                    {{ $proveedor->persona->tipo_persona }}
                                </td>
                                <td>
                                    @if ($proveedor->persona->estado == 1)
                                        <span class="badge rounded-pill text-bg-success">activo</span>
                                    @else
                                        <span class="badge rounded-pill text-bg-danger">eliminado</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex justify-content-around">

                                        <div>
                                            <button title="Opciones"
                                                class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg class="svg-inline--fa fa-ellipsis-vertical" aria-hidden="true"
                                                    focusable="false" data-prefix="fas" data-icon="ellipsis-vertical"
                                                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512"
                                                    data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                        d="M56 472a56 56 0 1 1 0-112 56 56 0 1 1 0 112zm0-160a56 56 0 1 1 0-112 56 56 0 1 1 0 112zM0 96a56 56 0 1 1 112 0A56 56 0 1 1 0 96z">
                                                    </path>
                                                </svg>
                                            </button>
                                            <ul class="dropdown-menu text-bg-light" style="font-size: small;">
                                                <!-----Editar proveedore--->

                                                <li><a class="dropdown-item"
                                                        href="{{ route('proveedores.edit', ['proveedore' => $proveedor]) }}">Editar</a>
                                                </li>

                                            </ul>
                                        </div>
                                        <div>
                                            <!----Separador----->
                                            <div class="vr"></div>
                                        </div>
                                        <div>
                                            <!------Eliminar proveedore---->
                                            @if ($proveedor->persona->estado == 1)
                                                <button title="Eliminar" data-bs-toggle="modal"
                                                    data-bs-target="#confirmModal-{{ $proveedor->id }}"
                                                    class="btn btn-datatable btn-icon btn-transparent-dark">
                                                    <svg class="svg-inline--fa fa-trash-can" aria-hidden="true"
                                                        focusable="false" data-prefix="far" data-icon="trash-can"
                                                        role="img" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 448 512" data-fa-i2svg="">
                                                        <path fill="currentColor"
                                                            d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            @else
                                                <button title="Restaurar" data-bs-toggle="modal"
                                                    data-bs-target="#confirmModal-{{ $proveedor->id }}"
                                                    class="btn btn-datatable btn-icon btn-transparent-dark">
                                                    <i class="fa-solid fa-rotate"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            <!-- Modal de confirmación-->
                            <div class="modal fade" id="confirmModal-{{ $proveedor->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            {{ $proveedor->persona->estado == 1 ? '¿Seguro que quieres eliminar el proveedor?' : '¿Seguro que quieres restaurar el proveedor?' }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cerrar</button>
                                            <form
                                                action="{{ route('proveedores.destroy', ['proveedore' => $proveedor->persona->id]) }}"
                                                method="post">
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
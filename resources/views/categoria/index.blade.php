@extends('template')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush

@section('content')
    @if (session('success'))
        <script>
            let message = "{{session('success')}}"
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
        <h1 class="mt-4 text-center">Categorias</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active">Categorias</li>
        </ol>

        <div class="row mb-4">
            <a href="{{ route('categorias.create') }}"><button type="button" class="btn btn-primary">Agregar nuevo registro</button></a>
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
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td>
                                    {{ $categoria->caracteristica->nombre }}
                                </td>
                                <td>
                                    {{ $categoria->caracteristica->descripcion }}
                                </td>
                                <td>
                                    @if ($categoria->caracteristica->estado == 1) <span class="fw-bolder p-1 rounded bg-success text-white"> ACTIVO </span>
                                        @else <span class="fw-bolder p-1 rounded bg-danger text-white"> INACTIVO </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                        <form action="{{ route('categorias.edit', ['categoria' => $categoria]) }}"
                                            method="get">
                                            <button type="submit" class="btn btn-warning">Editar</button>
                                        </form>

                                        @if ($categoria->caracteristica->estado == 1)
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$categoria->id}}">Eliminar</button>
                                        @else
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#confirmModal-{{$categoria->id}}">Restaurar</button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="confirmModal-{{$categoria->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensaje de confirmación</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        {{$categoria->caracteristica->estado == 1 ? '¿Seguro que deseas eliminar esta categoría?' : '¿Seguro que deseas restaurar esta categoría?'}}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{route('categorias.destroy',['categoria'=>$categoria->id])}}" method="post">
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

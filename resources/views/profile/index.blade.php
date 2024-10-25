@extends('template')


@section('title', 'Perfil')

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

    <div class="container">
        <h1 class="mt-4 text-center">Configurar Perfil</h1>
        <div class="container card mt-4">
            <form class="card-body" action="{{ route('profile.update', ['profile' => $user]) }}" method="POST">
                @method('PATCH')
                @csrf
                <!-- Nombre -->
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-square-check"></i></span>
                            <input disabled type="text" class="form-control" value="Nombres">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                </div>
                <br>
                <!-- Email -->
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-square-check"></i></span>
                            <input disabled type="text" class="form-control" value="Email">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                </div>
                <br>
                <!-- Password -->
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-square-check"></i></span>
                            <input disabled type="text" class="form-control" value="Contraseña">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                </div>
                <br>
                <!-- Confirm Password -->
                <div class="row">
                    <div class="col-sm-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-square-check"></i></span>
                            <input disabled type="text" class="form-control" value="Confirmar contraseña">
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success">Guardar cambios</button>
                    </div>
                </div>
            </form>

        </div>

    </div>

@endsection

@push('js')
@endpush

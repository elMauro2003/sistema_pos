@extends('template')

@section('title', 'Crear Usuario')

@push('css')
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Crear Usuario</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('users.index') }}">Roles</a></li>
            <li class="breadcrumb-item active">Crear Usuario</li>
        </ol>

        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{ route('users.store') }}" method="post">
                @csrf
                <!-- Nombre -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nombres</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                        @error('name')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                </div>
                <!-- Email -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
                        @error('email')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                </div>
                <!-- Rol -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="role" class="form-label">Rol</label>
                        <select name="role" id="role" class="form-select">
                            <option value="" selected disabled>Seleccione</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" @selected(old('role') == $role->name)>{{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                </div>
                <!-- Password -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password">
                        @error('password')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                </div>
                <!-- Verificacion de Password -->
                <div class="row">
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Verifique su Contraseña</label>
                        <input type="password" class="form-control" name="password_confirmation">
                        @error('password_confirmation')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>

@endsection

@push('js')
@endpush

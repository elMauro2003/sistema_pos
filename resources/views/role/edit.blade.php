@extends('template')

@section('title', 'Editar categoria')

@push('css')
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Editar Rol</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('roles.index') }}">Roles</a></li>
            <li class="breadcrumb-item active">Editar Rol</li>
        </ol>

        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{route('roles.update',['role'=>$role])}}" method="post">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="{{old('nombre', $role->name)}}">
                        @error('nombre')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="" class="form-label">Permisos para el rol</label>
                        <div class="border p-2 overflow-auto" style="max-height: 200px;">
                            @foreach ($permisos as $permiso)
                            @if (in_array($permiso->id, $role->permissions->pluck('id')->toArray()))
                            <div class="form-check mb-2">
                                <input checked type="checkbox" name="permission[]" id="{{ $permiso->id }}"
                                    class="form-check-input" value="{{ $permiso->id }}">
                                <label for="{{ $permiso->id }}" class="form-check-label">{{ $permiso->name }}</label>
                            </div>
                            @else
                            <div class="form-check mb-2">
                                <input type="checkbox" name="permission[]" id="{{ $permiso->id }}"
                                    class="form-check-input" value="{{ $permiso->id }}">
                                <label for="{{ $permiso->id }}" class="form-check-label">{{ $permiso->name }}</label>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                    @error('permission')
                        <small class="text-danger">{{ '* ' . $message }}</small>
                    @enderror
                </div>
                <hr>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <button type="reset" class="btn btn-secondary">Reiniciar</button>
            </form>
        </div>

    </div>
@endsection

@push('js')
@endpush

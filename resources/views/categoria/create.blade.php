@extends('template')

@section('title', 'Crear categorias')

@push('css')
<style>
    #descripcion{
        resize: none;
    }
</style>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Crear categorias</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('categorias.index') }}">Categorias</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('categorias.create') }}">Crear categoria</a></li>
        </ol>

        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{route('categorias.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="nombre" class="form-label">Nombre </label>
                        <input type="text" class="form-control" name="nombre" id="nombre">
                        @error('nombre')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea type="textarea" class="form-control" name="descripcion" id="descripcion" cols="30" rows="10">{{old('descripcion')}}</textarea>
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

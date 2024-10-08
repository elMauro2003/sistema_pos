@extends('template')

@section('title', 'Crear Producto')

@push('css')
    <style>
        #descripcion{
            resize: none;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Crear producto</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('productos.index') }}">Productos</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('productos.create') }}">Crear producto</a></li>
        </ol>

        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{route('productos.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="codigo" class="form-label">Código</label>
                        <input type="text" name="codigo" class="form-control" id="codigo" value="{{old('codigo')}}">
                        @error('codigo')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" value="{{old('nombre')}}">
                        @error('nombre')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="fecha_vencimiento" class="form-label">Fecha de Vencimiento</label>
                        <input type="date" name="fecha_vencimiento" class="form-control" id="fecha_vencimiento" value="{{old('fecha_vencimiento')}}">
                        @error('fecha_vencimiento')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="img_path" class="form-label">Imagen</label>
                        <input type="file" name="img_path" class="form-control" id="img_path" value="{{old('img_path')}}" accept="Image/*">
                        @error('img_path')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="marca_id" class="form-label">Marca</label>
                        <select data-live-search="true" title="Seleccione una marca" data-size='4' name="marca_id" id="marca_id" class="form-control selectpicker show-tick">
                            @foreach ($marcas as $marca)
                                <option value="{{$marca->id}}" {{old('marca_id') == $marca->id ? 'selected' : ''}} >{{$marca->nombre}}</option>
                            @endforeach
                        </select>
                        @error('marca_id')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="presentacione_id" class="form-label">Presentación</label>
                        <select data-live-search="true" title="Seleccione una presentacion" data-size='4' name="presentacione_id" id="presentacione_id" class="form-control selectpicker show-tick">
                            @foreach ($presentaciones as $presentacion)
                                <option value="{{$presentacion->id}}" {{old('presentacione_id') == $presentacion->id ? 'selected' : ''}}>{{$presentacion->nombre}}</option>
                            @endforeach
                        </select>
                        @error('presentacione_id')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="presentacione_id" class="form-label">Categorías</label>
                        <select data-live-search="true" title="Seleccione una categoría" data-size='4' name="categorias[]" id="categorias" class="form-control selectpicker show-tick" multiple>
                            @foreach ($categorias as $categoria)
                                <option value="{{$categoria->id}}" {{ (in_array($categoria->id, old('categorias',[]))) ? 'selected' : '' }}> {{$categoria->nombre}} </option>
                            @endforeach
                        </select>
                        @error('categorias')
                            <small class="text-danger">{{'* '.$message}}</small>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea name="descripcion" class="form-control" id="descripcion" cols="30" rows="10">{{old('descripcion')}}</textarea>
                        @error('descripcion')
                            <small class="text-danger">{{'* '.$message}}</small>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endpush

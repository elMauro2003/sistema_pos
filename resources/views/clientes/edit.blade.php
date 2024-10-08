@extends('template')

@section('title', 'Editar Cliente')

@push('css')
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Crear cliente</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('clientes.index') }}">Clientes</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('clientes.create') }}">Crear cliente</a></li>
        </ol>

        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{ route('clientes.update', ['cliente' => $cliente]) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="row">
                    <!-- Tipo persona -->
                    <div class="col-md-5">
                        <label for="tipo_persona" class="form-label">Tipo de Persona:
                            <span class="fw-bold">{{ strtoupper($cliente->persona->tipo_persona) }}</span> 
                        </label>
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <!-- Razon social -->
                    <div class="col-md-5" id="box-razon-social">
                        @if ($cliente->persona->tipo_persona == 'natural')
                            <label id="label-natural" for="" class="form-label">Nombres y Apellidos</label>
                        @else
                            <label id="label-juridica" for="" class="form-label">Nombre de la empresa</label>
                        @endif
                        <input type="text" name="razon_social" id="razon_social" class="form-control"
                            value="{{ old('razon_social', $cliente->persona->razon_social) }}">
                        @error('razon_social')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <!-- Direccion -->
                    <div class="col-md-8">
                        <label for="direccion" class="form-label">Dirección</label>
                        <input type="address" name="direccion" class="form-control"
                            value="{{ old('direccion', $cliente->persona->direccion) }}">
                        @error('direccion')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <!-- Documento -->
                    <div class="col-md-4">
                        <label for="documento_id" class="form-label">Documento</label>
                        <select name="documento_id" id="documento_id" class="form-select">
                            @foreach ($documentos as $documento)
                                @if ($documento->id == $cliente->persona->documento_id)
                                    <option selected value="{{ $documento->id }}"
                                        {{ old('documento_id') == $documento->id ? 'selected' : '' }}>
                                        {{ $documento->tipo_documento }}
                                    </option>
                                @else
                                    <option value="{{ $documento->id }}"
                                        {{ old('documento_id') == $documento->id ? 'selected' : '' }}>
                                        {{ $documento->tipo_documento }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('documento_id')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <!-- Numero Documento -->
                    <div class="col-md-6">
                        <label for="numero_documento" class="form-label">Numero de Documento</label>
                        <input type="text" class="form-control" name="numero_documento" value="{{old('numero_documento', $cliente->persona->numero_documento)}}">
                        @error('numero_documento')
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

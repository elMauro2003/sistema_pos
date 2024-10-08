@extends('template')

@section('title', 'Crear Cliente')

@push('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        #box-razon-social {
            display: none;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4 text-center">Editar cliente</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active"><a href="{{ route('panel') }}">Inicio</a></li>
            <li class="breadcrumb-item active"><a href="{{ route('clientes.index') }}">Clientes</a></li>
            <li class="breadcrumb-item active">Editar cliente</li>
        </ol>

        <div class="container w-100 border border-3 border-primary rounded p-4 mt-3">
            <form action="{{ route('clientes.update') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-5">
                        <label for="tipo_persona" class="form-label">Tipo de Persona: </label>
                        <!-- Tipo persona -->
                        <select name="tipo_persona" id="tipo_persona" class="form-select">
                            <option selected disabled value="">Selecciona una opción</option>
                            <option value="natural" {{ old('tipo_persona') == 'natural' ? 'selected' : '' }}>Persona Natural
                            </option>
                            <option value="juridica" {{ old('tipo_persona') == 'juridica' ? 'selected' : '' }}>Persona
                                Jurídica</option>
                        </select>
                        @error('tipo_persona')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <!-- Razon social -->
                    <div class="col-md-12" id="box-razon-social">
                        <label id="label-natural" for="" class="form-label">Nombres y Apellidos</label>
                        <label id="label-juridica" for="" class="form-label">Nombre de la empresa</label>
                        <input type="text" name="razon_social" id="razon_social" class="form-control" value="{{ old('razon_social') }}">
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
                        <input type="address" name="direccion" class="form-control" value="{{old('direccion')}}">
                        @error('direccion')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="documento_id" class="form-label">Documento</label>
                        <select name="documento_id" id="documento_id" class="form-select">
                            <option selected disabled value="">Selecciona una opción</option>
                            @foreach ($documentos as $documento)
                                <option value="{{ $documento->id }}"
                                    {{ old('documento_id') == $documento->id ? 'selected' : '' }}>
                                    {{ $documento->tipo_documento }}
                                </option>
                            @endforeach
                        </select>
                        @error('documento_id')
                            <small class="text-danger">{{ '* ' . $message }}</small>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="numero_documento" class="form-label">Numero de Documento</label>
                        <input type="text" class="form-control" name="numero_documento">
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
    <script>
        $(document).ready(function() {
            $('#tipo_persona').on('change', function() {
                let selectedValue = $(this).val();
                if (selectedValue == 'natural') {
                    $('#label-juridica').hide();
                    $('#label-natural').show();
                } else {
                    $('#label-natural').hide();
                    $('#label-juridica').show();
                }
                $('#box-razon-social').show();
            });
        });
    </script>
@endpush

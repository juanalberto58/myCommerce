@extends('layouts.app')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Crear Nuevo Contacto</div>
                    <div class="card-body">
                        <form action="{{ route('store.contacts') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="dni">Dni:</label>
                                <input type="text" name="dni" id="dni" class="form-control" required>
                                @error('dni')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lastname">Apellidos:</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" required></textarea>
                                @error('lastname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" name="email" id="email" class="form-control" required></textarea>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Direccion:</label>
                                <input type="text" name="address" id="address" class="form-control" required></textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefono:</label>
                                <input type="text" name="phone" id="phone" class="form-control" required></textarea>
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group row mb-0">
                                <label for="checklist" class="col-md-4 col-form-label text-md-right">Seleccionar tipo:</label>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="proveedor" id="proveedorRadio" name="contactType">
                                        <label class="form-check-label" for="proveedorRadio">
                                            Proveedor
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="cliente" id="clienteRadio" name="contactType">
                                        <label class="form-check-label" for="clienteRadio">
                                            Cliente
                                        </label>
                                    </div>
                                    @error('contactType')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Contacto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

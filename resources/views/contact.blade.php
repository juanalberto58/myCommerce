@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Contacto: {{ $contact->id }}</div>
                    <div class="card-body">
                        <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="dni">Dni</label>
                                <input type="text" name="dni" id="dni" class="form-control" value="{{ $contact->dni }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $contact->name }}">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Apellidos</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $contact->lastname }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ $contact->email }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Direccion</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $contact->address }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Telefono</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $contact->phone }}">
                            </div>
                            <div class="form-group row mb-0">
                                <label for="checklist" class="col-md-4 col-form-label text-md-right">Seleccionar tipo:</label>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="proveedor" id="proveedorRadio" name="type" @if($contact->type === 'proveedor') checked @endif>
                                        <label class="form-check-label" for="proveedorRadio">
                                            Proveedor
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="cliente" id="clienteRadio" name="type" @if($contact->type === 'cliente') checked @endif>
                                        <label class="form-check-label" for="clienteRadio">
                                            Cliente
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <button id="deleteContactButton" class="btn btn-danger delete-user" data-id="{{ $contact->id }}">Eliminar Contacto</button>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Contactos</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre:</label>
                            <div class="col-md-6">
                                <input type="text" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="channel" class="col-md-4 col-form-label text-md-right">Dni:</label>
                            <div class="col-md-6">
                                <input type="text" id="dni" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <label for="checklist" class="col-md-4 col-form-label text-md-right">Seleccionar tipo:</label>
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="proveedor" id="proveedorCheck">
                                    <label class="form-check-label" for="proveedorCheck">
                                        Proveedor
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" value="cliente" id="clienteCheck">
                                    <label class="form-check-label" for="clienteCheck">
                                        Cliente
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button id="filtrarContactos" type="button" class="btn btn-primary">Filtrar</button>
                                <button id="limpiarFiltro" type="button" class="btn btn-secondary">Limpiar Filtro</button>
                                <a href="{{ route('create_contact') }}" class="btn btn-success">Crear Contacto</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">Listado de Contactos</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody id="contacts-table-body">
                            <script>
                                var contacts = {!! $contactsJson !!};
                            </script>                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



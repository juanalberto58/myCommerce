@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Ventas</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">Fecha:</label>
                            <div class="col-md-6">
                                <input type="date" id="fecha" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="channel" class="col-md-4 col-form-label text-md-right">Nombre cliente:</label>
                            <div class="col-md-6">
                                <input type="text" id="proveedor" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button id="filtrarVentas" type="button" class="btn btn-primary">Filtrar</button>
                                <button id="limpiarFiltro" type="button" class="btn btn-secondary">Limpiar Filtro</button>
                                <a href="{{ route('sales.create') }}" class="btn btn-success">Crear Pedido Manual</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">Listado de Ventas</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Cliente</th>
                                    <th>Fecha</th>
                                    <th>Precio Coste</th>
                                    <th>Iva</th>
                                    <th>Total</th>
                                    <th>Margen</th>
                                </tr>
                            </thead>
                            <tbody id="ventas-table-body">
                            <script>
                                var sales = {!! $salesJson !!};
                                var contactsData = {!! $contactsJson !!};
                            </script>                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

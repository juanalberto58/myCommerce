@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Compras</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">Fecha:</label>
                            <div class="col-md-6">
                                <input type="date" id="fecha" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="proveedor" class="col-md-4 col-form-label text-md-right">Proveedor:</label>
                            <div class="col-md-6">
                                <select id="proveedor" class="form-control select2"></select>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button id="filtrarCompras" type="button" class="btn btn-primary">Filtrar</button>
                                <button id="limpiarFiltro" type="button" class="btn btn-secondary">Limpiar Filtro</button>
                                <a href="{{ route('purchases.create') }}" class="btn btn-success">Crear Pedido Manual</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">Listado de Compras</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Referencia</th>
                                    <th>Fecha</th>
                                    <th>Proveedor</th>
                                    <th>Base Imponible</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="compras-table-body">
                            <script>
                                var purchases = {!! $purchasesJson !!};
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



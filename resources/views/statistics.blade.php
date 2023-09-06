@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Estadísticas</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="fechaInicio" class="col-md-4 col-form-label text-md-right">Fecha de inicio:</label>
                        <div class="col-md-6">
                            <input type="date" id="fechaInicio" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="fechaFin" class="col-md-4 col-form-label text-md-right">Fecha de fin:</label>
                        <div class="col-md-6">
                            <input type="date" id="fechaFin" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="button" class="btn btn-primary" id="filterButton">Generar Informe</button>
                            <button type="button" class="btn btn-primary" id="downloadButton" style="display: none;">Descargar Informe</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Informe de Ventas</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Total Facturacion</th>
                                <th>Margen</th>
                            </tr>
                        </thead>
                        <tbody id="salesTableContainer">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Productos Vendidos</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Producto</th>
                                <th>Cantidad Vendida</th>
                            </tr>
                        </thead>
                        <tbody id="productsTableContainer">
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">Producto más Rentable</div>
                <div class="card-body">
                    <div id="resultadoProductoMasRentable">
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">Gráfica</div>
                <div class="card-body">
                    <script>
                        var salesJson = {!! $salesJson !!};
                        var salesLinesJson = {!! $salesLinesJson !!};
                        var productsJson = {!! $productsJson !!};
                    </script>
                    <canvas id="salesChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

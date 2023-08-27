@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Estadísticas</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="fecha" class="col-md-4 col-form-label text-md-right">Fecha:</label>
                            <div class="col-md-6">
                                <input type="date" id="fecha" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="channel" class="col-md-4 col-form-label text-md-right">Canal de ventas:</label>
                            <div class="col-md-6">
                                <input type="text" id="proveedor" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" class="btn btn-primary" id="filterButton">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">Gráfica</div>
                    <div class="card-body">
                        <script>
                            var salesJson = {!! $salesJson !!};
                        </script>
                        <canvas id="salesChart" width="400" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



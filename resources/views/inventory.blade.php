@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Inventario</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="referencia" class="col-md-4 col-form-label text-md-right">Referencia:</label>
                        <div class="col-md-6">
                            <input type="text" id="referencia" class="form-control">
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
                            <div class="btn-group" role="group" aria-label="Actions">
                                <button id="filtrarInventario" type="button" class="btn btn-primary">Filtrar</button>
                                <button id="limpiarFiltro" type="button" class="btn btn-secondary">Limpiar Filtro</button>
                                <div class="mx-2"></div>
                                <a href="{{ route('products.create') }}" class="btn btn-primary">Crear Producto</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Productos</div>
                <div class="card-body">
                    <div class="row" id="productos-container">
                        <tbody id="inventory-table-body">
                            <script>
                                var contactsData = {!! $contactsJson !!};
                            </script>
                        </tbody>

                        @foreach($products as $prod)
                        <div class="col-md-3 mb-4">
                            <a href="{{ route('products.show', $prod->id) }}" class="card-link">
                                <div class="card">
                                    <img src="{{ $prod->image }}" class="card-img-top" alt="{{ $prod->reference }}" style="width: 200px;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $prod->reference }}</h5>
                                        <p class="card-text">{{ $prod->name }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

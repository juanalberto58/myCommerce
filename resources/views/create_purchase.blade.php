@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Crear pedido de Compra</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="contact_id" class="col-md-4 col-form-label text-md-right">Proveedor:</label>
                        <div class="col-md-6">
                            <script>
                                var purchases = {!! $purchasesJson !!};
                                var contactsData = {!! $contactsJson !!};
                                var productsData = {!! $productsJson !!};
                            </script>
                            <select id="contact_id" class="form-control select2"></select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
            <div class="card">
                <div class="card-header">Agregar lineas</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="product_id" class="col-md-4 col-form-label text-md-right">Producto:</label>
                        <div class="col-md-6">
                            <select id="product_id" class="form-control select2" required></select>
                            <!-- <input type="text" id="product_id" class="form-control"> -->
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" class="col-md-4 col-form-label text-md-right">Cantidad:</label>
                        <div class="col-md-6">
                            <input type="text" id="quantity" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tax_base" class="col-md-4 col-form-label text-md-right">Base Imponible:</label>
                        <div class="col-md-6">
                            <input type="text" id="tax_base" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tax" class="col-md-4 col-form-label text-md-right">Iva:</label>
                        <div class="col-md-6">
                            <input type="text" id="tax" value='21' class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <div class="btn-group" role="group" aria-label="Actions">
                                <button id="addButton" type="button" class="btn btn-primary">Añadir Línea de Pedido</button>
                                <div class="mx-2"></div> 
                                <button id="createPurchaseOrder" type="button" class="btn btn-primary">Crear Pedido de Compra</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
            <div class="card-header">Lineas de pedido</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Base Imponible</th>
                                <th>Iva</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="lineasPedidoTableBody">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script src="{{ asset('js/purchase.js') }}"></script>
@endsection

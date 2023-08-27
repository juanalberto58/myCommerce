@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Crear pedido de Compra</div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="reference" class="col-md-4 col-form-label text-md-right">Referencia:</label>
                        <div class="col-md-6">
                            <input type="text" id="reference" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="supplier" class="col-md-4 col-form-label text-md-right">Proveedor:</label>
                        <div class="col-md-6">
                            <input type="text" id="supplier" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="quantity" class="col-md-4 col-form-label text-md-right">Cantidad:</label>
                        <div class="col-md-6">
                            <input type="text" id="quantity" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tax_base" class="col-md-4 col-form-label text-md-right">Base Imponible:</label>
                        <div class="col-md-6">
                            <input type="text" id="tax_base" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tax" class="col-md-4 col-form-label text-md-right">Iva:</label>
                        <div class="col-md-6">
                            <input type="text" id="tax" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <!-- Botones de "Añadir Línea de Pedido" y "Crear Pedido de Compra" en una fila con separación -->
                            <div class="btn-group" role="group" aria-label="Actions">
                                <button id="addButton" type="button" class="btn btn-primary">Añadir Línea de Pedido</button>
                                <div class="mx-2"></div> <!-- Separación de 2 unidades (puedes ajustarla según tu preferencia) -->
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
                                <th>Referencia</th>
                                <th>Proveedor</th>
                                <th>Cantidad</th>
                                <th>Base Imponible</th>
                                <th>Iva</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody id="lineasPedidoTableBody">
                            <!-- Aquí se reflejarán las líneas de pedido agregadas -->
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

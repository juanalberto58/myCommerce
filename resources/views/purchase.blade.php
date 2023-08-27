@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <form action="{{ route('purchases.update', $purchase->id) }}" method="POST">
                @csrf
                @method('PUT')    
                <div class="card">
                    <div class="card-header">Pedido {{ $purchase->id }}</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="form-group col-md-4">
                                <label for="date">Fecha</label>
                                <input type="text" name="date" id="date" class="form-control" value="{{ $purchase->date }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="contact_id">Proveedor</label>
                                <input type="text" name="contact_id" id="contact_id" class="form-control" value="{{ $purchase->contact_id }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="user_id">Creado por:</label>
                                <input type="text" name="user_id" id="user_id" class="form-control" value="{{ $purchase->user_id }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tax_base">Precio coste:</label>
                            <input type="text" name="tax_base" id="tax_base" class="form-control" value="{{ $purchase->tax_base }}">
                        </div>
                        <div class="form-group">
                            <label for="tax">Iva:</label>
                            <input type="text" name="tax" id="tax" class="form-control" value="{{ $purchase->tax }}">
                        </div>
                        <div class="form-group">
                            <label for="total">Total Pedido:</label>
                            <input type="text" name="total" id="total" class="form-control" style="width: 300px;"value="{{ $purchase->total }}">
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">Lineas de pedido</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Referencia</th>
                                    <th>Proveedor</th>
                                    <th>Cantidad</th>
                                    <th>Base Imponible</th>
                                    <th>Iva</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody id="lines-table-body">
                            @foreach($purchase->purchaseLines as $index => $linea)
                            <tr>
                                <td><input type="text" name="lines[{{ $index }}][reference]" class="form-control editable-input" value="{{ $linea->reference }}"></td>
                                <td><input type="text" name="lines[{{ $index }}][supplier]" class="form-control editable-input" value="{{ $linea->supplier }}"></td>
                                <td><input type="text" name="lines[{{ $index }}][quantity]" class="form-control editable-input" style="width: 100px;" value="{{ $linea->quantity }}"></td>
                                <td><input type="text" name="lines[{{ $index }}][wholesale_price]" class="form-control editable-input" style="width: 100px;" value="{{ $linea->wholesale_price }}"></td>
                                <td><input type="text" name="lines[{{ $index }}][tax]" class="form-control editable-input" style="width: 80px;" value="{{ $linea->tax }}"></td>
                                <td><input type="text" name="lines[{{ $index }}][total]" class="form-control editable-input" style="width: 100px;" value="{{ $linea->total }}"></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 300px;">Guardar Cambios</button>
                <button id="deletePurchaseButton" class="btn btn-danger delete-purchase" data-id="{{ $purchase->id }}">Eliminar Pedido</button>
            </form>
            </div>
        </div>
    </div>
@endsection

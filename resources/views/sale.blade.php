@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
            <form action="{{ route('sales.update', $sale->id) }}" method="POST">
                @csrf
                @method('PUT')    
                <div class="card">
                    <div class="card-header">Pedido {{ $sale->id }}</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="form-group col-md-4">
                                <label for="date">Fecha:</label>
                                <input type="text" name="date" id="date" class="form-control" value="{{ $sale->date }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="contact_id">Cliente:</label>
                                <input type="text" name="contact_id" id="contact_id" class="form-control" value="{{ $sale->contact_id }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="user_id">Creado por:</label>
                                <input type="text" name="user_id" id="user_id" class="form-control" value="{{ $sale->user_id }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tax_base">Precio coste:</label>
                                <input type="text" name="tax_base" id="tax_base" class="form-control" value="{{ $sale->tax_base }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tax">Iva:</label>
                                <input type="text" name="tax" id="tax" class="form-control" value="{{ $sale->tax }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="total">Total Pedido:</label>
                                <input type="text" name="total" id="total" class="form-control" value="{{ $sale->total }}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="margin">Margen total:</label>
                                <input type="text" name="margin" id="margin" class="form-control" value="{{ $sale->margin }}">
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
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Base Imponible</th>
                                    <th>Iva</th>
                                    <th>Total</th>
                                    <th>Precio Venta</th>
                                    <th>Margen</th>
                                </tr>
                            </thead>
                            <tbody id="lines-table-body">
                            @foreach($sale->saleLines as $index => $linea)
                            <tr>
                                <td><input type="text" name="lines[{{ $index }}][product_id]" class="form-control editable-input" value="{{ $linea->product_id }}"></td>
                                <td><input type="text" name="lines[{{ $index }}][quantity]" class="form-control editable-input" style="width: 100px;" value="{{ $linea->quantity }}"></td>
                                <td><input type="text" name="lines[{{ $index }}][wholesale_price]" class="form-control editable-input" style="width: 100px;" value="{{ $linea->wholesale_price }}"></td>
                                <td><input type="text" name="lines[{{ $index }}][tax]" class="form-control editable-input" style="width: 80px;" value="{{ $linea->tax }}"></td>
                                <td><input type="text" name="lines[{{ $index }}][salePrice]" class="form-control editable-input" style="width: 100px;" value="{{ $linea->salePrice }}"></td>
                                <td><input type="text" name="lines[{{ $index }}][margin]" class="form-control editable-input" style="width: 100px;" value="{{ $linea->margin }}"></td>
                                <td><input type="text" name="lines[{{ $index }}][total]" class="form-control editable-input" style="width: 100px;" value="{{ $linea->total }}"></td>

                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" style="width: 300px;">Guardar Cambios</button>
                <button id="deleteSaleButton" class="btn btn-danger delete-purchase" data-id="{{ $sale->id }}">Eliminar Pedido</button>    
            </form>
            </div>
        </div>
    </div>
@endsection



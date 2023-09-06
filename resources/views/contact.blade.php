@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Primer Card -->
                <div class="card">
                    <div class="card-header">Contacto: {{ $contact->id }}</div>
                    <div class="card-body">
                        <form action="{{ route('contacts.update', $contact->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="text" name="dni" id="dni" class="form-control" value="{{ $contact->dni }}">
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $contact->name }}">
                            </div>
                            <div class="form-group">
                                <label for="lastname">Apellidos</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $contact->lastname }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ $contact->email }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Dirección</label>
                                <input type="text" name="address" id="address" class="form-control" value="{{ $contact->address }}">
                            </div>
                            <div class="form-group">
                                <label for="phone">Teléfono</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{ $contact->phone }}">
                            </div>
                            <div class="form-group row mb-0">
                                <label for="checklist" class="col-md-4 col-form-label text-md-right">Seleccionar tipo:</label>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="proveedor" id="proveedorRadio" name="type" @if($contact->type === 'proveedor') checked @endif>
                                        <label class="form-check-label" for="proveedorRadio">
                                            Proveedor
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="cliente" id="clienteRadio" name="type" @if($contact->type === 'cliente') checked @endif>
                                        <label class="form-check-label" for="clienteRadio">
                                            Cliente
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    <button id="deleteContactButton" class="btn btn-danger delete-user" data-id="{{ $contact->id }}">Eliminar Contacto</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                    <div class="card mt-3">
                        <div class="card-header">Pedidos del Contacto</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <tbody>
                                    @if ($purchases->isNotEmpty() || $sales->isNotEmpty())
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Fecha</th>
                                                    <th>Tax Base</th>
                                                    <th>Impuesto</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($purchases->isEmpty() ? $sales : $purchases as $transaction)
                                                <tr>
                                                    <td><a href="{{ route($transaction instanceof App\Models\Purchase ? 'purchases.show' : 'sales.show', $transaction->id) }}">{{ $transaction->id }}</a></td>
                                                    <td>{{ $transaction->date }}</td>
                                                    <td>{{ $transaction->tax_base }}</td>
                                                    <td>{{ $transaction->tax }}</td>
                                                    <td>{{ $transaction->total }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p>No hay registros disponibles.</p>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                <script>
                    var purchases = {!! $purchases !!};
                    var sales = {!! $sales !!};
                </script>            
            </div>
        </div>
    </div>
@endsection

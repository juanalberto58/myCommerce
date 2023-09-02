@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Crear Nuevo Producto</div>
                    <div class="card-body">
                        <form action="{{ route('store.products') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="reference">Referencia del Producto:</label>
                                <input type="text" name="reference" id="reference" class="form-control" required>
                                @error('reference')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre del Producto:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                                @error('nombre')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="descripcion">Descripción del Producto:</label>
                                <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
                                @error('descripcion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="weight">Peso GR:</label>
                                <input type="text" name="weight" id="weight" class="form-control" required>
                                @error('weight')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="height">Altura CM:</label>
                                <input type="text" name="height" id="height" class="form-control" required>
                                @error('height')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="width">Ancho CM:</label>
                                <input type="text" name="width" id="width" class="form-control" required>
                                @error('width')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="length">Largo CM:</label>
                                <input type="text" name="length" id="length" class="form-control" required>
                                @error('length')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Precio:</label>
                                <input type="text" name="price" id="price" class="form-control" required>
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="stock">Stock:</label>
                                <input type="text" name="stock" id="stock" class="form-control" required>
                                @error('stock')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="contact_id">Proveedor:</label>
                                <input type="text" name="contact_id" id="contact_id" class="form-control" required>
                                @error('contact_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="imagen">URL de la Imagen:</label>
                                <input type="text" name="imagen" id="imagen" class="form-control" required>
                                @error('imagen')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Detalles del Producto</div>
            <div class="card-body">
                <h3>{{ $product->reference }}</h3>
                <p>{{ $product->name }}</p>
                <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->image }}" style="width: 200px;">
                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Referencia</label>
                        <input type="text" name="reference" id="reference" class="form-control" value="{{ $product->reference }}">
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <textarea name="name" id="name" class="form-control">{{ $product->name }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="weight">Peso</label>
                        <textarea name="weight" id="weight" class="form-control">{{ $product->weight }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="height">Altura</label>
                        <textarea name="height" id="height" class="form-control">{{ $product->height }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="width">Ancho</label>
                        <textarea name="width" id="width" class="form-control">{{ $product->width }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="length">Largo</label>
                        <textarea name="length" id="length" class="form-control">{{ $product->length }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Precio</label>
                        <textarea name="price" id="price" class="form-control">{{ $product->price }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="stock">Stock</label>
                        <textarea name="stock" id="stock" class="form-control">{{ $product->stock }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="contact_id">Proveedor</label>
                        <textarea name="contact_id" id="contact_id" class="form-control">{{ $product->contact_id }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen</label>
                        <textarea name="imagen" id="imagen" class="form-control">{{ $product->image }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <button id="deleteProductButton" class="btn btn-danger delete-product" data-id="{{ $product->id }}">Eliminar Producto</button>    
                </form>
            </div>
        </div>
    </div>
@endsection

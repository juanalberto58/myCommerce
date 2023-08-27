@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Detalles del Producto</div>
            <div class="card-body">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->description }}</p>
                <form action="{{ route('products.update', $product->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    <button id="deleteProductButton" class="btn btn-danger delete-product" data-id="{{ $product->id }}">Eliminar Producto</button>    
                </form>
            </div>
        </div>
    </div>
@endsection

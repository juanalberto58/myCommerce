<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Funcion para ver los detalles de un producto.
    public function show($id)
    {       
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('inventory.index')->with('error', 'El producto no existe.');
        }

        return view('product', compact('product'));
    }

    // Funcion para actualizar los detalles de un producto.
    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('inventory.index')->with('error', 'El producto no existe.');
        }

        $product->reference = $request->input('reference');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->weight = $request->input('weight');
        $product->height = $request->input('height');
        $product->width = $request->input('width');
        $product->length = $request->input('length');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->contact_id = $request->input('contact_id');
        $product->image = $request->input('imagen');

        $product->save();

        return redirect()->route('products.show', $product->id)->with('success', 'El producto se ha actualizado correctamente.');
    }

    // Funcion para redirigir a la vista de creacion de prodcutos.
    public function create()
    {
        return view('create_product');
    }

    // Funcion para crear y guardar en la bbdd prodcutos.
    public function store(Request $request)
    {
        $product = new Product();
        $product->reference = $request->input('reference');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->weight = $request->input('weight');
        $product->height = $request->input('height');
        $product->width = $request->input('width');
        $product->length = $request->input('length');
        $product->price = $request->input('price');
        $product->stock = $request->input('stock');
        $product->contact_id = $request->input('contact_id');
        $product->image = $request->input('imagen');
        $product->user_id = auth()->id();

        $product->save();

        return redirect()->route('products.show', $product->id)->with('success', 'Producto creado exitosamente.');
    }

    // Funcion para eliminar un producto concreto.
    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['success' => false]);
        }

        $success = $product->delete();

        return response()->json(['success' => 'Producto eliminado correctamente.']);
    }




}

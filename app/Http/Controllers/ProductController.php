<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show($id)
    {        
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('inventory.index')->with('error', 'El producto no existe.');
        }

        return view('product', compact('product'));
    }


    public function update(Request $request, $id)
    {

        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('inventory.index')->with('error', 'El producto no existe.');
        }

        $product->name = $request->input('name');
        $product->description = $request->input('description');

        $product->save();

        return redirect()->route('products.show', $product->id)->with('success', 'El producto se ha actualizado correctamente.');
    }

    public function create()
    {
        return view('create_product');
    }

    public function store(Request $request)
    {
        $product = new Product();
        $product->reference = $request->input('reference');
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->image = $request->input('image');
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

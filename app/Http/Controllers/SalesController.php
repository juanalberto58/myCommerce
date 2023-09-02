<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Contact;
use App\Models\Product;

class SalesController extends Controller
{
    // Funcion para mostrar la vista de inicio de los pedidos de ventas
    public function index()
    {
        $sales = Sale::all();
        $contacts = Contact::all();

        $salesJson = $sales->toJson();
        $contactsJson = $contacts->toJson();

        return view('sales', compact('salesJson', 'contactsJson'));
    }

    // Funcion para redirigir a la vista de creacion de pedidos de ventas
    public function create()
    {
        $contacts = Contact::all();
        $products = Product::all();

        $contactsJson = $contacts->toJson();
        $productsJson = $products->toJson();

        return view('create_sale', compact('contactsJson', 'productsJson'));
    }

    // Funcion para redirigir a la vista de ventas
    public function showView()
    {
        return view('sales'); 
    }

    // Funcion para guardar un pedido de venta en la bbdd
    public function store(Request $request)
    {
        $data = $request->json()->all();

        $success = Sale::createSale($data);
    
        return response()->json(["success" => $success]);
    }

    // Funcion para mostrar un pedido de venta concreto
    public function show($id)
    {
        try {
            $sale = Sale::find($id);

            $contacts = Contact::whereIn('id', $sale->saleLines->pluck('contact_id'))->get();
            $products = Product::whereIn('id', $sale->saleLines->pluck('product_id'))->get();

            return view('sale', compact('sale', 'contacts', 'products'));
        } catch (\Exception $e) {
            return redirect()->route('sales.index')->with('error', 'El pedido no pudo encontrarse.');
        }
    }

    // Funcion para actualizar los datos de un pedido de venta concreto.
    public function update(Request $request, $id)
    {
        $sale = Sale::find($id);
    
        if (!$sale) {
            return redirect()->route('sales.index')->with('error', 'El pedido de venta no existe.');
        }
    
        // Actualizar los datos del pedido
        $sale->date = $request->input('date');
        $sale->contact_id = $request->input('contact_id');
        $sale->user_id = $request->input('user_id');
        $sale->tax_base = $request->input('tax_base');
        $sale->tax = $request->input('tax');
        $sale->total = $request->input('total');
    
        $sale->save();
    
        // Recoger y actualizar las líneas de pedido
        $lines = $request->input('lines', []);
        foreach ($lines as $lineIndex => $lineData) {
            $line = $sale->saleLines[$lineIndex];
            $line->product_id = $lineData['product_id'];
            $line->quantity = $lineData['quantity'];
            $line->wholesale_price = $lineData['wholesale_price'];
            $line->tax = $lineData['tax'];
            $line->total = $lineData['total'];
            $line->save();
        }
    
        return redirect()->route('sales.show', $sale->id)->with('success', 'El pedido de venta y las líneas de pedido se han actualizado correctamente.');
    }

    // Funcion para eliminar un pedido de venta concreto.
    public function delete($id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return response()->json(['success' => false]);
        }

        $sale->saleLines()->delete();

        $success = $sale->delete();

        return response()->json(['success' => 'Pedido de venta y líneas de pedido eliminados con éxito.']);
    }
}

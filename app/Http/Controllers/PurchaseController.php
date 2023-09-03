<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Contact;
use App\Models\Product;


class PurchaseController extends Controller
{
    // Funcion para mostrar los pedidos de compra en la vista ademas de los contactos.
    public function index()
    {
        $purchases = Purchase::all();
        $contacts = Contact::all();

        $purchasesJson = $purchases->toJson();
        $contactsJson = $contacts->toJson();

        return view('purchases', compact('purchasesJson', 'contactsJson'));
    }
    
    public function showView()
    {
        return view('purchases'); 
    }

    // Redirigimos a la vista de creacion de pedido
    public function create(Request $request)
    {
        $purchases = Purchase::all();
        $contacts = Contact::all();
        $products = Product::all();

        $purchasesJson = $purchases->toJson();
        $contactsJson = $contacts->toJson();
        $productsJson = $products->toJson();

        return view('create_purchase', compact('purchasesJson', 'contactsJson', 'productsJson'));
    }

    // Funcion para guardar un nuevo pedido.
    public function store(Request $request)
    {
        $data = $request->json()->all();

        $success = Purchase::createPurchase($data);

        $productController = new ProductController();

        foreach ($data['lineasPedido'] as $linea) {
            $product = Product::find($linea['product_id']);
            if ($product) {
                $productController->actualizarStock($product, $linea['quantity']);
            }
        }
    
        return response()->json(["success" => $success]);
    }

    // Funcion para mostrar un pedido concreto.
    public function show($id)
    {
        try {
            $purchase = Purchase::find($id);
            
            // Obtener los nombres de proveedores y productos correspondientes
            $contacts = Contact::whereIn('id', $purchase->purchaseLines->pluck('contact_id'))->get();
            $products = Product::whereIn('id', $purchase->purchaseLines->pluck('product_id'))->get();

            return view('purchase', compact('purchase', 'contacts', 'products'));
        } catch (\Exception $e) {
            return redirect()->route('purchases.index')->with('error', 'El pedido no pudo encontrarse.');
        }
    }

    // Funcion para actualizar los datos de un pedido concreto.
    public function update(Request $request, $id)
    {
        $purchase = Purchase::find($id);
    
        if (!$purchase) {
            return redirect()->route('purchases.index')->with('error', 'El pedido de compra no existe.');
        }
    
        // Actualizar los datos del pedido
        $purchase->date = $request->input('date');
        $purchase->contact_id = $request->input('contact_id');
        $purchase->user_id = $request->input('user_id');
        $purchase->tax_base = $request->input('tax_base');
        $purchase->tax = $request->input('tax');
        $purchase->total = $request->input('total');
    
        $purchase->save();
    
        // Recoger y actualizar las líneas de pedido
        $lines = $request->input('lines', []);
        foreach ($lines as $lineIndex => $lineData) {
            $line = $purchase->purchaseLines[$lineIndex];
            $line->product_id = $lineData['product_id'];
            $line->quantity = $lineData['quantity'];
            $line->wholesale_price = $lineData['wholesale_price'];
            $line->tax = $lineData['tax'];
            $line->total = $lineData['total'];
            $line->save();
        }
    
        return redirect()->route('purchases.show', $purchase->id)->with('success', 'El pedido de compra y las líneas de pedido se han actualizado correctamente.');
    }

    // Funcion para eliminar un pedido de compra concreto.
    public function delete($id)
    {
        $purchase = Purchase::find($id);
        
        if (!$purchase) {
            return response()->json(['success' => false]);
        }

        $purchase->purchaseLines()->delete();

        $success = $purchase->delete();
    
        return response()->json(['success' => 'Pedido de compra y líneas de pedido eliminados con éxito.']);
    }

    
}

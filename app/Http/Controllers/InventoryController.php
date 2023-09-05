<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Contact;

class InventoryController extends Controller
{
    // Funcion para mostrar los productos en la vista ademas de los contactos.
    public function index()
    {

        $products = Product::all();
        $contacts = Contact::all();

        $contactsJson = $contacts->toJson();

        return view('inventory', compact('products', 'contactsJson'));
    }
}
?>

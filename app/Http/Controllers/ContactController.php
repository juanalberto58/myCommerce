<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    // Funcion para mostrar la vista de inicio de los contactos
    public function index()
    {
        $contacts = Contact::all();
        $contactsJson = $contacts->toJson();
        return view('contacts', compact('contactsJson'));
    }

    // Funcion para redirigir a la vista de creacion de contactos
    public function create()
    {
        return view('create_contact');
    }

    // Funcion para guardar un contacto en la bbdd
    public function store(Request $request)
    {

        $request->validate([
            'dni' => 'required|regex:/^[0-9]{8}[A-Za-z]$/',
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|min:9',
            'contactType' => 'required|in:proveedor,cliente'
        ], [
            'email.email' => 'El formato del correo electrónico no es válido.',
            'phone.min' => 'El telefono debe contener 9 dígitos.',
            'dni.regex' => 'El DNI debe tener 8 dígitos numéricos.',
            'contactType.in' => 'Selecciona un tipo válido: Proveedor o Cliente.'
        ]);

        $data = $request->all();
        $selectedType = $request->input('contactType'); 
        $success = Contact::createContact($data,$selectedType);
        return redirect()->route('contacts.index')->with('success', 'Contacto creado exitosamente.');
    }

    // Funcion para mostrar un contacto concreto
    public function show($id)
    {
        try {
            $contact = Contact::find($id);
    
            if (!$contact) {
                return redirect()->route('contacts.index')->with('error', 'El contacto no pudo encontrarse.');
            }
    
            $purchases = Purchase::where('contact_id', $id)->orderBy('created_at', 'desc')->take(10)->get();
            $sales = Sale::where('contact_id', $id)->orderBy('created_at', 'desc')->take(10)->get();

            return view('contact', compact('contact','sales','purchases'));
        } catch (\Exception $e) {
            return redirect()->route('contacts.index')->with('error', 'El contacto no pudo encontrarse.');
        }
    }

    // Funcion para actualizar los datos de un contacto concreto.
    public function update(Request $request, $id)
    {

        $contact = Contact::find($id);

        if (!$contact) {
            return redirect()->route('contact.index')->with('error', 'El contacto no existe.');
        }
        
        $contact->dni = $request->input('dni');
        $contact->name = $request->input('name');
        $contact->lastname = $request->input('lastname');
        $contact->address = $request->input('address');
        $contact->phone = $request->input('phone');
        $contact->email = $request->input('email');
        $contact->type = $request->input('type');

        $contact->save();

        return redirect()->route('contact.show', $contact->id)->with('success', 'El contact se ha actualizado correctamente.');
    }


    // Funcion para eliminar un contacto concreto.
    public function delete($id)
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return response()->json(['success' => false]);
        }

        $success = $contact->delete();

        return response()->json(['success' => 'Contacto eliminado correctamente.']);
    }
}

?>

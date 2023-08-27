<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        $contactsJson = $contacts->toJson();
        return view('contacts', compact('contactsJson'));
    }

    public function create()
    {
        return view('create_contact');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $selectedType = $request->input('contactType'); // Obtener el valor seleccionado
        $success = Contact::createContact($data,$selectedType);
        return redirect()->route('create_contact')->with('success', 'Contacto creado exitosamente.');
    }

    public function show($id)
    {
        try {
            $contact = Contact::find($id); // Cambia "$purchase" a "$contact"
            return view('contact', compact('contact')); // Cambia "compact('purchase')" a "compact('contact')"
        } catch (\Exception $e) {
            return redirect()->route('contacts.index')->with('error', 'El contacto no pudo encontrarse.');
        }
    }

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

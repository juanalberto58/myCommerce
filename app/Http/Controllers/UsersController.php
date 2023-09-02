<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    // Funcion para mostrar la vista de inicio de los usuarios
    public function index()
    {
        $users = User::all();
        $usersJson = $users->toJson();
        return view('users', compact('usersJson'));
    }

    // Funcion para redirigir a la vista de creacion de usuarios
    public function create()
    {
        return view('create_user');
    }

    // Funcion para guardar un usuario en la bbdd
    public function store(Request $request)
    {
        $data = $request->all();
        $selectedType = $request->input('is_admin'); 
        $success = User::createUser($data,$selectedType);
        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente.');
    }

    // Funcion para mostrar un usuario concreto
    public function show($id)
    {
        try {
            $user = User::find($id); 
            return view('user', compact('user')); 
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'El usuario no pudo encontrarse.');
        }
    }

    // Funcion para actualizar los datos de un usuario concreto.
    public function update(Request $request, $id)
    {

        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'El usuario no existe.');
        }
        
        if (auth()->user()->id == $user->id || auth()->user()->is_admin) {
            $user->dni = $request->input('dni');
            $user->name = $request->input('name');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->is_admin = $request->input('type');
    
            $user->save();
    
            return redirect()->route('users.index', $user->id)->with('success', 'El usuario se ha actualizado correctamente.');
        } else {
            return redirect()->route('users.index')->with('error', 'No tienes permiso para editar este perfil');
        }
    }

    // Funcion para eliminar un usuario concreto.
    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false]);
        }

        $success = $user->delete();

        return response()->json(['success' => 'Usuario eliminado correctamente.']);
    }
}

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Usuario {{ $user->id }}</div>
                    <div class="card-body">
                        <form action="{{ route('user.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <div class="form-group col-md-4">
                                <label for="dni">Dni:</label>
                                <input type="text" name="dni" id="dni" class="form-control" value="{{ $user->dni }}" @if(!auth()->user()->is_admin && auth()->user()->id !== $user->id) disabled @endif>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="email">Email:</label>
                                <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" @if(!auth()->user()->is_admin && auth()->user()->id !== $user->id) disabled @endif>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="name">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" @if(!auth()->user()->is_admin && auth()->user()->id !== $user->id) disabled @endif>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lastname">Apellidos:</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" value="{{ $user->lastname }}" @if(!auth()->user()->is_admin && auth()->user()->id !== $user->id) disabled @endif>
                            </div>
                            @if ((auth()->user()->is_admin || auth()->user()->id === $user->id) && auth()->user()->id === $user->id)
                                <div class="form-group col-md-4">
                                    <label for="password">Nueva Contraseña:</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            @endif
                            <div class="form-group row mb-0">
                                <label for="checklist" class="col-md-4 col-form-label text-md-right">¿Administrador?:</label>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="1" id="is_admin_yes" name="type"
                                            @if($user->is_admin === 1) checked @endif @if(!auth()->user()->is_admin) disabled @endif>
                                        <label class="form-check-label" for="is_admin_yes">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="0" id="is_admin_no" name="type"
                                            @if($user->is_admin === 0) checked @endif @if(!auth()->user()->is_admin) disabled @endif>
                                        <label class="form-check-label" for="is_admin_no">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (auth()->user()->is_admin || (auth()->user()->id === $user->id))
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        @endif

                        @if (auth()->user()->is_admin)
                            <button id="deleteUserButton" class="btn btn-danger delete-user" data-id="{{ $user->id }}">Eliminar Usuario</button>
                        @endif
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



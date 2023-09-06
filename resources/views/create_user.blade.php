@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Crear Usuario</div>
                    <div class="card-body">
                        <form action="{{ route('store.users') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="dni">Dni:</label>
                                <input type="text" name="dni" id="dni" class="form-control" required>
                                @error('dni')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="lastname">Apellidos:</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" required>
                                @error('lastname')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="text" name="email" id="email" class="form-control" required>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group row mb-0">
                                <label for="checklist" class="col-md-4 col-form-label text-md-right">¿Es administrador?:</label>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="1" id="is_admin_yes" name="is_admin">
                                        <label class="form-check-label" for="is_admin_yes">
                                            Si
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="0" id="is_admin_no" name="is_admin">
                                        <label class="form-check-label" for="is_admin_no">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

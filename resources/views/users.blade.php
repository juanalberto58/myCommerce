@extends('layouts.app')
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Usuarios</div>
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre:</label>
                            <div class="col-md-6">
                                <input type="text" id="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="channel" class="col-md-4 col-form-label text-md-right">Dni:</label>
                            <div class="col-md-6">
                                <input type="text" id="dni" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button id="filterUsers" type="button" class="btn btn-primary">Filtrar</button>
                                <button type="button" class="btn btn-secondary" id="clearFiltersButton">Quitar Filtros</button>
                                @if (auth()->check() && auth()->user()->is_admin)
                                    <a href="{{ route('create_user') }}" class="btn btn-success">Crear Usuario</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-4">
                    <div class="card-header">Listado de Usuarios</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Dni</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody id="users-table-body">
                            <script>
                                var users = {!! $usersJson !!};
                            </script>                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

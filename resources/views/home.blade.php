@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inicio</div>
                <div class="card-body">
                    <div class="button-container">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="button">
                                    <a href="{{ route('purchases.index') }}">
                                        <div class="button-content">
                                            Compras
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="button">
                                    <a href="{{ route('sales.index') }}">
                                        <div class="button-content">
                                            Ventas
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="button">
                                    <a href="{{ route('inventory.index') }}">
                                        <div class="button-content">
                                            Inventario
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="button">
                                    <a href="{{ route('contacts.index') }}">
                                        <div class="button-content">
                                            Contactos
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="button">
                                    <a href="{{ route('statistics.index') }}">
                                        <div class="button-content">
                                            Estadisticas
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="button">
                                    <a href="{{ route('users.index') }}">
                                        <div class="button-content">
                                            Usuarios
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
@parent
<link href="{{ asset('css/theme.css') }}" rel="stylesheet">
@endsection
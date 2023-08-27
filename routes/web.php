<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StatisticsController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('/login');
});



//Grupo de rutas solo serán accesibles para los usuarios con rol de administrador
// Route::group(['middleware' => 'auth'], function () {
Route::get('/', 'App\Http\Controllers\Auth\LoginController@showLoginForm');
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('/register', 'App\Http\Controllers\Auth\RegisterController@register');

// Rutas de Compras
Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
Route::get('/purchases/create', [PurchaseController::class, 'create'])->name('purchases.create');
Route::get('/purchases/{id}', [PurchaseController::class, 'show'])->name('purchases.show');
Route::put('/purchases/{id}', [PurchaseController::class, 'update'])->name('purchases.update');
Route::post('/purchases/store', [PurchaseController::class, 'store'])->name('store.purchases');
Route::delete('/purchases/{id}', [PurchaseController::class, 'delete'])->name('purchases.delete');


// Rutas de Ventas
Route::get('/sales', [SalesController::class, 'index'])->name('sales.index');
Route::get('/sales/create', [SalesController::class, 'create'])->name('sales.create');
Route::get('/sales/{id}', [SalesController::class, 'show'])->name('sales.show');
Route::put('/sales/{id}', [SalesController::class, 'update'])->name('sales.update');
Route::post('/sales/store', [SalesController::class, 'store'])->name('store.sales');
Route::delete('/sales/{id}', [SalesController::class, 'delete'])->name('sales.delete');


// Rutas del Inventario
// Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory');
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
Route::post('/products', [ProductController::class, 'store'])->name('store.products');
Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('products.delete');

// Rutas de Contactos
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('/contacts/create', [ContactController::class, 'create'])->name('create_contact');
Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contact.show');
Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');
Route::post('/contacts/store', [ContactController::class, 'store'])->name('store.contacts');
Route::delete('/contacts/{id}', [ContactController::class, 'delete'])->name('contacts.delete');

// Rutas de Contactos
Route::get('/users', [UsersController::class, 'index'])->name('users.index');
Route::get('/users/create', [UsersController::class, 'create'])->name('create_user');
Route::get('/users/{id}', [UsersController::class, 'show'])->name('user.show');
Route::put('/users/{id}', [UsersController::class, 'update'])->name('user.update');
Route::post('/users/store', [UsersController::class, 'store'])->name('store.users');
Route::delete('/users/{id}', [UsersController::class, 'delete'])->name('users.delete');

// Rutas de Estadisticas
Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

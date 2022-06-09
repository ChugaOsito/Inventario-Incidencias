<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\DetalleController;

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/instrucciones', function () {
    return view('instructions');
});

Route::get('/acerca-de', function () {
    return view('credits');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/seleccionar/proyecto/{id}', 'HomeController@selectProject');

Route::group(['middleware' => 'auth', 'namespace' => 'User'], function (){
    Route::post('/profile/image', 'ProfileController@postImage');
});
//Si se agrega una nueva ruta ejecutar el siguiente comando: php artisan optimize

//Inicidente
Route::get('/reportar', 'IncidentController@create');
Route::post('/reportar', 'IncidentController@store');

Route::get('/incidencia/{id}/editar', 'IncidentController@edit');
Route::post('/incidencia/{id}/editar', 'IncidentController@update');

Route::get('/incidencia/{id}/utilizar', 'IncidentController@utilizar');
Route::post('/incidencia/{id}/utilizar', 'IncidentController@actualizar');

Route::get('/ver/{id}', 'IncidentController@show');

Route::get('/incidencia/{id}/atender', 'IncidentController@take');
Route::get('/incidencia/{id}/resolver', 'IncidentController@solve');
Route::get('/incidencia/{id}/abrir', 'IncidentController@open');
Route::get('/incidencia/{id}/derivar', 'IncidentController@nextLevel');

Route::post('/mensajes', 'MessageController@store');
//Logs
Route::get('/activity/log/incidencia', 'IncidentController@activityLog')->name('activity/log/incidencia');

//Inventario
Route::get('/productos', 'ProductoController@index');
Route::resource('/productos', ProductoController::class);
Route::get('/productos', 'ProductoController@getProducto')->name('productos');

Route::post('/productos', 'ProductoController@postProducto');

Route::get('/productos/create', 'ProductoController@getProductoCreate');
Route::post('/productos/create', 'ProductoController@postProductoCreate');

Route::post('/productos/{id}/editar', 'ProductoController@update')->name('producto.update');
Route::get('/productos/{id}/editar', 'ProductoController@edit');

Route::get('/productos/{id}/eliminar', 'ProductoController@delete');
Route::get('/productos/{id}/restaurar', 'ProductoController@restore');

Route::get('/productos/{id}/show', 'ProductoController@show')->name('producto.show');
//Anexos
Route::post('/productos/{id}/anexos', 'ProductoController@anexar')->name('producto.anexar');
Route::get('/productos/{id}/anexos', 'ProductoController@anexos');
//Buscar
//Logs
Route::get('/activity/Log', 'UserController@activityLog')->name('activity/log');


Route::name('imprimir')->get('/imprimir-pdf', 'ProductoController@imprimir');
Route::get('export', 'ProductoController@exportExcel')->name('producto.export');

//Logs
Route::get('/activity/log/producto', 'ProductoController@activityLog')->name('activity/log/producto');

//Rutas de autenticación
Route::post('/contraseña/editar', 'UserController@update_password')->name('update_password');

//Codigo
Route::get('/codigos', 'CodigoController@index')->name('codigos');
Route::get('/codigos/create', 'CodigoController@create')->name('codigos/create');
Route::post('/codigos/create', 'CodigoController@store');
Route::post('/codigos/{id}/editar', 'CodigoController@update');
Route::get('/codigos/{id}/editar', 'CodigoController@edit');
Route::get('/codigos/{id}/eliminar', 'CodigoController@delete');

Route::group(['middleware' => 'admin', 'namespace' => 'Admin'], function () {

//Usuarios
Route::get('/usuarios', 'UserController@index');

Route::post('/usuarios', 'UserController@store');

Route::get('/contraseña/{id}', 'UserController@change_password');
Route::post('/contraseña/{id}', 'UserController@update_password');

Route::get('/usuario/{id}', 'UserController@edit');
Route::post('/usuario/{id}', 'UserController@update');

Route::get('/usuario/{id}/eliminar', 'UserController@delete');
Route::get('/usuario/{id}/restaurar', 'UserController@restore');

// Project
Route::get('/proyectos', 'ProjectController@index');
Route::post('/proyectos', 'ProjectController@store');

Route::get('/proyecto/{id}', 'ProjectController@edit');
Route::post('/proyecto/{id}', 'ProjectController@update');

Route::get('/proyecto/{id}/eliminar', 'ProjectController@delete');
Route::get('/proyecto/{id}/restaurar', 'ProjectController@restore');

    // Category
Route::post('/categorias', 'CategoryController@store');
Route::post('/categoria/editar', 'CategoryController@update');
Route::get('/categoria/{id}/eliminar', 'CategoryController@delete');

    // Level
Route::post('/niveles', 'LevelController@store');
Route::post('/nivel/editar', 'LevelController@update');
Route::get('/nivel/{id}/eliminar', 'LevelController@delete');

// Project-User
Route::post('/proyecto-usuario', 'ProjectUserController@store');
Route::get('/proyecto-usuario/{id}/eliminar', 'ProjectUserController@delete');

Route::get('/config', 'ConfigController@index');

//Logs
Route::get('/activity/Log', 'UserController@activityLog')->name('activity/log');
});




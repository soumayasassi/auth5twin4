<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard/todo', function () {
    return view('todo');
})->name('dashboard-todo');

Route::get('students', \App\Http\Livewire\Crud::class);


Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles', \App\Http\Controllers\RoleController::class);
    Route::resource('tasks', \App\Http\Controllers\TaskController::class);
    Route::resource('users', \App\Http\Controllers\UserController::class);



});

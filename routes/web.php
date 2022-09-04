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
require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('/auth/login');
});

Route::view('/{any}', 'dashboard')
    ->middleware(['auth'])
    ->name('dashboard')
    ->where('any', '.*');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// Route::get('/tasks/index', function () {
//     return view('todo');
// })->middleware(['auth'])->name('todo');



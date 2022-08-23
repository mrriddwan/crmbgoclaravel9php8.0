<?php

use App\Http\Controllers\Api\ContactCategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ContactStatusController;
use App\Http\Controllers\Api\ContactTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Contact API*/
Route::get('/contacts/index', [ContactController::class, 'index'])->name('contact:index');
Route::get('/contacts/create', [ContactController::class, 'store'])->name('contact:store');
Route::get('/contacts/show/{contact}', [ContactController::class, 'show'])->name('contact:show');
Route::put('/contacts/update/{contact}', [EmployeeController::class, 'update'])->name('contact:update');
Route::delete('/contacts/delete/{contact}', [EmployeeController::class, 'delete'])->name('contact:delete');

/*Sub-Contact API*/
Route::get('"/api/contactCategory/index"', [ContactCategoryController::class, 'index'])->name('category:index');
Route::get('/api/contactType/index', [ContactTypeController::class, 'index'])->name('type:index');
Route::get('/api/contactStatus/index', [ContactStatusController::class, 'index'])->name('status:index');
Route::get('/api/user/index', [UserController::class, 'index'])->name('user:index');





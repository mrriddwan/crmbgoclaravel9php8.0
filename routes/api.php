<?php

use App\Http\Controllers\Api\ContactCategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ContactStatusController;
use App\Http\Controllers\Api\ContactTypeController;
use App\Http\Controllers\Api\UserController;
use App\Models\ContactIncharge;
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
Route::put('/contacts/update/{contact}', [ContactController::class, 'update'])->name('contact:update');
Route::delete('/contacts/delete/{contact}', [ContactController::class, 'delete'])->name('contact:delete');

/*Sub-Contact API*/
Route::get('/contactcategory/index', [ContactCategoryController::class, 'index'])->name('category:index');
Route::get('/contacttype/index', [ContactTypeController::class, 'index'])->name('type:index');
Route::get('/contactstatus/index', [ContactStatusController::class, 'index'])->name('status:index');
Route::get('/user/index', [UserController::class, 'index'])->name('user:index');
Route::get('/incharges/index', [UserController::class, 'index'])->name('incharge:index');
Route::get('/incharges/show/{incharge}', [ContactIncharge::class, 'show'])->name('incharge:show');






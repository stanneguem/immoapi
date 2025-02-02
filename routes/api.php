<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\propertyCategorieController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('immo/v1/login', [AuthController::class, 'login']);
Route::post('immo/v1/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('immo/v1/addcategorie', [PropertyCategorieController::class, 'addCategorie']);
    Route::get('immo/v1/listcategories', [PropertyCategorieController::class, 'listCategories']);
    Route::delete('immo/v1/deletecategorie/{id}', [PropertyCategorieController::class, 'deleteCategorie']);
    Route::put('immo/v1/updateCategorie/{id}',[propertyCategorieController::class, 'updateCategorie']);
    Route::post('immo/v1/addpropert', [PropertyController::class, 'store']);
    Route::delete('immo/v1/deletepropert/{property}', [PropertyController::class, 'destroy']);
});

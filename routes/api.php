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

Route::post('v1/login', [AuthController::class, 'login']);
Route::post('v1/register', [AuthController::class, 'register']);
Route::get('v1/', [PropertyController::class, 'index']);
Route::get('v1/category', [PropertyCategorieController::class, 'listCategories']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('v1/category', [PropertyCategorieController::class, 'addCategorie']);
    Route::delete('v1/category/{id}', [PropertyCategorieController::class, 'deleteCategorie']);
    Route::put('v1/category/{id}',[propertyCategorieController::class, 'updateCategorie']);
    Route::post('v1/property', [PropertyController::class, 'store']);
    Route::delete('v1/property/{id}', [PropertyController::class, 'destroy']);
});

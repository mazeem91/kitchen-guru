<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CRMController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\MemberBoxController;
use App\Http\Controllers\IngredientController;

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

Route::post('/sanctum/token', [Controller::class, 'generateToken']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->apiResource('ingredients', IngredientController::class);

Route::middleware('auth:sanctum')->apiResource('recipes', RecipeController::class);

Route::middleware('auth:sanctum')->apiResource('member-boxes', MemberBoxController::class);

Route::middleware('auth:sanctum')->get('crm/ingredients-required', [CRMController::class, 'getRequiredIngredients']);


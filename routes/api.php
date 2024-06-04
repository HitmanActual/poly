<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\SubcategoryController;
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
//
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['prefix' => 'countries'], function () {

    Route::get('/', [CountryController::class, 'index']);

});

Route::group(['prefix' => 'categories'], function () {

    Route::get('/', [CategoryController::class, 'index']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::get('/{category}', [CategoryController::class, 'show']);
    Route::patch('/{category}', [CategoryController::class, 'update']);
    Route::delete('/{category}', [CategoryController::class, 'delete']);
    Route::post('/restore/{category}', [CategoryController::class, 'restore']);

});

Route::group(['prefix' => 'subcategories'], function () {

    Route::get('/', [SubcategoryController::class, 'index']);
    Route::post('/', [SubcategoryController::class, 'store']);
    Route::get('/{subcategory}', [SubcategoryController::class, 'show']);
    Route::patch('/{subcategory}', [SubcategoryController::class, 'update']);
    Route::delete('/{subcategory}', [SubcategoryController::class, 'delete']);
    Route::post('/restore/{subcategory}', [SubcategoryController::class, 'restore']);

});

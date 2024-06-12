<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ModeController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TranslationController;
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


Route::group(['prefix' => 'levels'], function () {

    Route::get('/', [LevelController::class, 'index']);

});


Route::group(['prefix' => 'modes'], function () {

    Route::get('/', [ModeController::class, 'index']);
    Route::post('/', [ModeController::class, 'store']);
    Route::get('/{mode}', [ModeController::class, 'show']);
    Route::patch('/{mode}', [ModeController::class, 'update']);
    Route::delete('/{mode}', [ModeController::class, 'delete']);
    Route::post('/restore/{mode}', [ModeController::class, 'restore']);

});


Route::group(['prefix' => 'languages'], function () {

    Route::get('/', [LanguageController::class, 'index']);

});


Route::group(['prefix' => 'subjects'], function () {

    Route::get('/', [SubjectController::class, 'index']);
    Route::post('/', [SubjectController::class, 'store']);
    Route::get('/{subject}', [SubjectController::class, 'show']);
    Route::patch('/{subject}', [SubjectController::class, 'update']);
    Route::delete('/{subject}', [SubjectController::class, 'delete']);
    Route::post('/restore/{subject}', [SubjectController::class, 'restore']);

});

Route::group(['prefix' => 'translations'], function () {

    Route::get('/', [TranslationController::class, 'index']);
    Route::post('/', [TranslationController::class, 'store']);
    Route::get('/{subject}', [TranslationController::class, 'show']);
    Route::patch('/{subject}', [TranslationController::class, 'update']);
    Route::delete('/{subject}', [TranslationController::class, 'delete']);
    Route::post('/restore/{subject}', [TranslationController::class, 'restore']);

});


Route::group(['prefix' => 'users'], function () {

    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout']);


});



Route::group(['prefix' => 'activities'], function () {

    Route::get('/', [ActivityController::class, 'index'])->middleware('auth:api');
    Route::post('/', [ActivityController::class, 'store'])->middleware('auth:api');

});



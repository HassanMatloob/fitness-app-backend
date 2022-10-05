<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Exercises;
use App\Http\Controllers\ApiController;


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

Route::get('test' ,function (Request $request) {
    $exercise = Exercises::all();
    return  response()->json(['status' => 'true', 'data' => $exercise]);
});

Route::get('get_all_categories' , [ApiController::class, 'get_all_categorie'])->name('get_all_categorie');
Route::get('get_all_exercise' , [ApiController::class, 'get_all_exercise'])->name('get_all_exercise');
Route::get('get_categorie_by_id/{id}' , [ApiController::class, 'get_categorie_by_id'])->name('get_categorie_by_id');
Route::get('get_exercise_by_id/{id}' , [ApiController::class, 'get_exercise_by_id'])->name('get_exercise_by_id');

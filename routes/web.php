<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DanoAIController;
use App\Http\Controllers\OpenAIController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/retomas/{retomaId}/analyze-image', [OpenAIController::class, 'analyzeImagesAndUpdateDescription']);
Route::get('/analyze-damage-images', [DanoAIController::class, 'analyzeDamageImagesAndUpdateDescription']);

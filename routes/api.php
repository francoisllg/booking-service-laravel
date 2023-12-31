<?php

use App\Http\Controllers\Api\V1\Accommodation\AccommodationController;
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

//Accommodations
Route::post('/user/{user_id}/accommodations', [AccommodationController::class, 'create']);
Route::get('/user/{user_id}/accommodations', [AccommodationController::class, 'getAllByUserId']);
Route::put('/user/{user_id}/accommodations/{accommodation_id}', [AccommodationController::class, 'update']);

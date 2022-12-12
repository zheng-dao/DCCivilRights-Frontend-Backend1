<?php

use App\Http\Controllers\API\TourController;
use App\Http\Controllers\API\PagesController;
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


Route::get("tour-list", [TourController::class, "tourList"]);
Route::get("tour-details/{id}", [TourController::class, "tourDetails"]);
Route::post("submit-load-gen-form", [TourController::class, "submitLoadGenForm"]);

Route::get("pages/{slug}", [PagesController::class, "pageDetails"]);
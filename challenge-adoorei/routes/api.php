<?php

use App\Http\Controllers\Product\ListProductsController;
use App\Http\Controllers\Sale\CreateSaleController;
use Illuminate\Support\Facades\Route;

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

Route::get('products', ListProductsController::class);
Route::post('sales', CreateSaleController::class);

<?php

use App\Http\Controllers\ListController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ResidentController;
use App\Models\Vahed;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [MainController::class, 'index'])->name('main');
Route::get('/list', [ListController::class, 'index'])->name('list');

// اپدیت فوری اقامتگر
Route::put('/residents/updateQuick/{resident}', [ResidentController::class, 'updateQuick'])->name('residents.updateQuick');
Route::put('/residents/update-all/{resident}', [ResidentController::class, 'updateAll'])->name('residents.updateAll');

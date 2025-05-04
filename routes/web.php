<?php

use App\Http\Controllers\DescriptionsController;
use App\Http\Controllers\InfoTakhtController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\SearchController;
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
Route::put('/resident/update/', [ResidentController::class, 'update'])->name('resident.update');
Route::put('/resident/getDasc/{resident}', [DescriptionsController::class, 'GetDescriptions'])->name('resident.getDesc');
Route::post('/resident/addDesc/', [DescriptionsController::class, 'AddDescriptions'])->name('resident.addDesc');
Route::post('/resident/deleteDesc/{description}', [DescriptionsController::class, 'DeleteDescriptions'])->name('resident.deleteDesc');
Route::post('/add_resident/', [ResidentController::class, 'AddResident'])->name('resident.addResident');

//امار تخت ها
Route::get('/takhts-showList', [InfoTakhtController::class,'showList'])->name('thakts.show');
Route::get('/search', [SearchController::class,'index'])->name('search');
Route::get('/search-list-resident', [SearchController::class,'showList'])->name('sarch.showList');

//softDelete and force resident
Route::get('/forcedelete_resident/{id}', [ResidentController::class, 'ForceDelete'])->name('resident.forcedelete');
Route::get('/softdelete_resident/{id}', [ResidentController::class, 'SoftDelete'])->name('resident.softdelete');

//change form and madrk
Route::get('resident_change_fm/', action: [ResidentController::class, 'ChangeFM'])->name('change_madrak_form');
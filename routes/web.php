<?php

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

use App\Http\Controllers\HomeController;

use App\Http\Controllers\ItemGroupController;





Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::any('/item-groups', [ItemGroupController::class, 'save'])->name('item-groups');
Route::any('/item-groups-masters-list', [ItemGroupController::class, 'index'])->name('item-groups-masters-list');
Route::post('/item-group-store', [ItemGroupController::class, 'store'])->name('itemgroup.store');
Route::any('/item-groups-master-list/edit/{id}', [ItemGroupController::class ,'edit'])->name('item-groups-masters.edit');
Route::post('/item-groups-master-list/update/{id}', [ItemGroupController::class ,'update'])->name('item-groups-masters.update');

Route::post('/item-groups-master-list/delete/{id?}', [ItemGroupController::class ,'delete'])->name('item-groups-masters.delete');
Route::post('/item-group/search',[ItemGroupController::class,'search'])->name('item-groups-masters.search');



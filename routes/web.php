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
use App\Http\Controllers\VendorMasterController;

use App\Http\Controllers\LocationMasterController;





Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();



//item-group routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::any('/item-groups', [ItemGroupController::class, 'save'])->name('item-groups');
Route::any('/item-groups-masters-list', [ItemGroupController::class, 'index'])->name('item-groups-masters-list');
Route::post('/item-group-store', [ItemGroupController::class, 'store'])->name('itemgroup.store');
Route::any('/item-groups-master-list/edit/{id}', [ItemGroupController::class ,'edit'])->name('item-groups-masters.edit');
Route::post('/item-groups-master-list/update/{id}', [ItemGroupController::class ,'update'])->name('item-groups-masters.update');
Route::post('/item-groups-master-list/delete/{id?}', [ItemGroupController::class ,'delete'])->name('item-groups-masters.delete');
Route::post('/item-group/search',[ItemGroupController::class,'search'])->name('item-groups-masters.search');


//vendor master-routes
Route::get('/vendor-master', [VendorMasterController::class, 'create'])->name('vendor.master');
Route::post('/vendor-master-store', [VendorMasterController::class, 'store'])->name('vendor.master.store');
Route::any('/vendor-master-list', [VendorMasterController::class, 'index'])->name('vendor.masters.list');
Route::any('/vendor-master-list/edit/{id}', [VendorMasterController::class ,'edit'])->name('vendor.master.list.edit');
Route::post('/vendor-master-list/update/{id}', [VendorMasterController::class ,'update'])->name('vendor.master.update');
Route::post('/vendor-master-list/delete/{id?}', [VendorMasterController::class ,'delete'])->name('vendor.master.delete');


//location master-routes

Route::get('/location-master', [LocationMasterController::class, 'create'])->name('location.master');
Route::post('/location-master-store', [LocationMasterController::class, 'store'])->name('location.master.store');
Route::any('/location-master-list', [LocationMasterController::class, 'index'])->name('location.master.list');
Route::any('/location-master-list/edit/{id}', [LocationMasterController::class ,'edit'])->name('location.master.list.edit');
Route::post('/location-master-list/update/{id}', [LocationMasterController::class ,'update'])->name('location.master.update');
Route::post('/location-master-list/delete/{id?}', [LocationMasterController::class ,'delete'])->name('location.master.delete');
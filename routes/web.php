<?php

use App\Http\Controllers\EmployeeMasterController;
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
use App\Http\Controllers\UserMasterController;
use App\Http\Controllers\DistrictMasterController;

use App\Http\Controllers\CourtMasterController;


use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;










Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



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

//employee master
Route::get('/employee-master', [EmployeeMasterController::class, 'create'])->name('employee.master');
Route::post('/employee-master-store', [EmployeeMasterController::class, 'store'])->name('employee.master.store');
Route::any('/employee-master-list', [EmployeeMasterController::class, 'index'])->name('employee.master.list');
Route::any('/employee-master-list/edit/{id}', [EmployeeMasterController::class ,'edit'])->name('employee.master.edit');
Route::post('/employee-master-list/update/{id}', [EmployeeMasterController::class ,'update'])->name('employee.master.update');
Route::post('/employee-master-list/delete/{id?}', [EmployeeMasterController::class ,'delete'])->name('employee.master.delete');



//user management routes
Route::get('/users-master', [UserMasterController::class, 'create'])->name('users.master');
Route::post('/users-master-store', [UserMasterController::class, 'store'])->name('users.master.store');
Route::any('/users-master-list', [UserMasterController::class, 'index'])->name('users.master.list');
Route::any('/users-master-list/edit/{id}', [UserMasterController::class ,'edit'])->name('users.master.edit');
Route::post('/users-master-list/update/{id}', [UserMasterController::class ,'update'])->name('users.master.update');
Route::post('/users-master-list/delete/{id?}', [UserMasterController::class ,'delete'])->name('users.master.delete');



///district routes
Route::get('/district-master', [DistrictMasterController::class, 'create'])->name('district.master');
Route::post('/district-master-store', [DistrictMasterController::class, 'store'])->name('district.master.store');
Route::any('/district-master-list', [DistrictMasterController::class, 'index'])->name('district.master.list');
Route::any('/district-master-list/edit/{id}', [DistrictMasterController::class ,'edit'])->name('district.master.edit');
Route::post('/district-master-list/update/{id}', [DistrictMasterController::class ,'update'])->name('district.master.update');
Route::post('/district-master-list/delete/{id?}', [DistrictMasterController::class ,'delete'])->name('district.master.delete');



//section routes

Route::get('/courts-master', [CourtMasterController::class, 'create'])->name('courts.master');
Route::post('/courts-master-store', [CourtMasterController::class, 'store'])->name('courts.master.store');
Route::any('/courts-master-list', [CourtMasterController::class, 'index'])->name('courts.master.list');
Route::any('/courts-master-list/edit/{id}', [CourtMasterController::class ,'edit'])->name('courts.master.edit');
Route::post('/courts-master-list/update/{id}', [CourtMasterController::class ,'update'])->name('courts.master.update');
Route::post('/courts-master-list/delete/{id?}', [CourtMasterController::class ,'delete'])->name('courts.master.delete');


Route::resources([
    'roles' => RoleController::class,
    'users' => UserController::class,
    'products' => ProductController::class,
]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

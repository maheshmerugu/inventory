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
use App\Http\Controllers\InventoryRequestController;
use App\Http\Controllers\ItemEntryController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;










Route::get('/', function () {
    return redirect()->route('login');
});





//section routes

Route::middleware('auth')->group(function () {


    //item-group routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::any('/itemgroup/create', [ItemGroupController::class, 'create'])->name('itemgroup.create');
Route::any('/itemgroup', [ItemGroupController::class, 'index'])->name('itemgroup.index');
Route::post('/itemgroup', [ItemGroupController::class, 'store'])->name('itemgroup.store');
Route::any('/itemgroup/edit/{id}', [ItemGroupController::class ,'edit'])->name('itemgroup.edit');
Route::post('/item-groups-master-list/update/{id}', [ItemGroupController::class ,'update'])->name('itemgroup.update');
Route::post('/item-groups-master-list/delete/{id?}', [ItemGroupController::class ,'delete'])->name('itemgroup.destroy');
Route::post('/item-group/search',[ItemGroupController::class,'search'])->name('item-groups-masters.search');


//item-entry routes

Route::any('/item-entry-create', [ItemEntryController::class, 'create'])->name('items.create');
Route::any('/item-entry-store', [ItemEntryController::class, 'store'])->name('items.store');
Route::get('/item-entry-index', [ItemEntryController::class, 'index'])->name('items.index');


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

//court master routes 
Route::get('/courts-master-create', [CourtMasterController::class, 'create'])->name('courts.master.create');
Route::post('/courts-master-store', [CourtMasterController::class, 'store'])->name('courts.master.store');
Route::any('/courts-master-list', [CourtMasterController::class, 'index'])->name('courts.master.list');
Route::any('/courts-master-list/edit/{id}', [CourtMasterController::class ,'edit'])->name('courts.master.edit');
Route::post('/courts-master-list/update/{id}', [CourtMasterController::class ,'update'])->name('courts.master.update');
Route::post('/courts-master-list/delete/{id?}', [CourtMasterController::class ,'delete'])->name('courts.master.delete');


//change password routes

Route::get('/change-password', [UserController::class, 'changePassword'])->name('user.password.change');
Route::post('/change-password-save', [UserController::class, 'changePasswordSave'])->name('user.password.save');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//inventory Request Routes 
Route::get('/inventory-request-create', [InventoryRequestController::class, 'create'])->name('inventory.request.create');
Route::post('/inventory-request-store', [InventoryRequestController::class, 'store'])->name('inventory.request.store');
Route::any('/inventory-request-list', [InventoryRequestController::class, 'index'])->name('inventory.request.list');
Route::any('/inventory-request-list/edit/{id}', [InventoryRequestController::class ,'edit'])->name('inventory.request.edit');
Route::post('/inventory-request-list/update/{id}', [InventoryRequestController::class ,'update'])->name('inventory.request.update');
Route::post('/inventory-request-list/delete/{id?}', [InventoryRequestController::class ,'delete'])->name('inventory.request.delete');

Route::post('/inventory-request-list/status/{id?}', [InventoryRequestController::class ,'statusChange'])->name('inventory.request.statuschange');
Route::any('/inventory-request-download', [InventoryRequestController::class ,'download'])->name('inventory.request.pdf.download');


Route::resources([
        'roles' => RoleController::class,
        'users' => UserController::class,
        'products' => ProductController::class,
        // 'itemgroup'=>ItemGroupController
    ]);
});

Auth::routes();


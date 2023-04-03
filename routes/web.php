<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController; 
use App\Http\Controllers\UserController; 
use App\Http\Controllers\RoleController; 
use App\Http\Controllers\AccountsController; 
use App\Http\Controllers\InvoiceController; 
use App\Http\Controllers\PermissionController; 
use App\Http\Controllers\ManifestController;  
use App\Http\Controllers\BranchClientsController; 
use App\Http\Controllers\InventoryController; 
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\ReturnBoxController;     
use App\Http\Controllers\TrackShipmentController;
use App\Http\Controllers\ShipmentsController; 
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\CategoriesController;    
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::view('test', 'accounts.invoice.pdf');

Auth::routes();
Route::view('account-settings','account-settings');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function() {
    Route::resource('/categories', CategoriesController::class);
    Route::group(['prefix'=>'accounts'], function(){
        Route::resource('/inventory', InventoryController::class);
        
        Route::resource('invoice', InvoiceController::class); 
        Route::get('current-shipment-weight/', [AdminSettingsController::class, 'currentShipmentRate']);
        Route::get('invoice/download/{id}', [InvoiceController::class, 'downloadInvoice']);
        Route::get('invoice/shipment/due-date', [InvoiceController::class, 'shipmentDueDate']);
        Route::resource('manifest', ManifestController::class);
        Route::post('download_manifest',[ManifestController::class, 'downloadManifestPDF']); 
        Route::post('download_manifest_excell',[ManifestController::class, 'downloadManifestExcell']);

        Route::get('reports', [ReportsController::class, 'ReportsIndexPage']); 
        Route::POST('reports/show', [ReportsController::class, 'ReportShow']); 

        
    });
    Route::group(['prefix'=>'cargo-master'], function(){
        Route::get('return-box', [ReturnBoxController::class, 'ReturnBoxIndexPage']);
        Route::get('return-box/create', [ReturnBoxController::class, 'ReturnBoxCreate']);
        Route::get('return-box/add', [ReturnBoxController::class, 'addItemToReturnBox']);
        Route::get('invoice/search', [ReturnBoxController::class, 'addFromInvoiceToReturnBox']);
        Route::get('shipments', [ShipmentsController::class, 'allShipmentsList']);
        Route::get('shipments/update-status/{id}', [ShipmentsController::class, 'shipmentUpdateStatusForm']);
        Route::post('shipments/change-status', [ShipmentsController::class, 'shipmentUpdateStatus']);
        Route::get('shipments/update-status', [ShipmentsController::class, 'shipmentStatusUpdate']);
        Route::POST('shipments/search', [ShipmentsController::class, 'searchShipment']);
        Route::resource('track-shipment', TrackShipmentController::class);
    });
    Route::resource('clients', BranchClientsController::class);
    Route::get('clients/export/excel', [BranchClientsController::class, 'branchClientExcelDownlad'] ); 
    Route::get('branch/searchUser', [BranchClientsController::class, 'SearchBranchUser'] ); 
    Route::get('branch/disable-user/{id}', [BranchClientsController::class, 'branchClientDisableSettings'] ); 
    Route::get('/admin-settings', [App\Http\Controllers\AdminSettingsController::class, 'index']);
    Route::post('/shipment-weight-price', [App\Http\Controllers\AdminSettingsController::class, 'shipmentWeightPrice']);

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('users', UserController::class);
    Route::get('users/disable/{id}', [UserController::class, 'userDisableSettings']);
    Route::get('users/account-settings/{id}', [UserController::class, 'userAccountSettings']);
    Route::resource('branch', BranchController::class)->middleware('role:Admin');
    Route::get('branch/disable/{id}', [BranchController::class, 'branchDisableSettings']);
});
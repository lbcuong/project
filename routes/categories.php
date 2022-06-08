<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\MeasuringUnitController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\ContainerController;
use App\Http\Controllers\ProductGroupCategoryController;
use App\Http\Controllers\ProducerController;
use App\Http\Controllers\MeasuringUnitConversionController;
use App\Http\Controllers\SupplierTypeController;
use App\Http\Controllers\CaseTypeController;
use App\Http\Controllers\CaseController;
use App\Http\Controllers\LocationWarehouseController;

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

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::match(['get', 'post'], 'measuring_units/{measuringUnit?}', [MeasuringUnitController::class,'index'])->name('measuring_units');
    Route::post('measuring_units/edit/{measuringUnit}',[MeasuringUnitController::class,'edit'])->name('measuring_units.edit');
    Route::delete('measuring_units/delete',[MeasuringUnitController::class,'destroy'])->name('measuring_units.delete');
});

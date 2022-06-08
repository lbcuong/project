<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReorderController;
use App\Http\Controllers\GoodsReceiptController;
use App\Http\Controllers\GoodsIssueController;


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

    //Reorder Guidelines Management
    Route::match(['get', 'post'], 'reorder_guidelines/{reorderGuideline?}', [ReorderController::class,'index'])->name('reorder_guidelines');
    Route::post('list/reorder_guidelines/edit/{reorderGuideline}',[ReorderController::class,'detail'])->name('reorder_guidelines.edit');
    Route::delete('reorders/delete}',[ReorderController::class,'destroy'])->name('reorder_guidelines.delete');
    Route::get('list/reorders',[ReorderController::class,'list'])->name('reorder_guidelines.list');
    Route::post('reorder_guidelines/approve/{reorderGuideline}',[ReorderController::class,'approve'])->name('reorder_guidelines.approve');
    Route::post('reorder_guidelines/reorder_items/edit',[ReorderController::class,'editItem'])->name('reorder_guidelines.reorder_items.edit');
    Route::post('reorder_guidelines/reorder_items/delete',[ReorderController::class,'deleteItem'])->name('reorder_guidelines.reorder_items.delete');

});

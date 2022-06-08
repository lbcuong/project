<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OverviewController;
use Illuminate\Http\Request;

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
    Route::get('/', function () {
        return view('dashboard');
    })->name('home');

    //BuildCodeId
    Route::post('build/code', function (Request $request) {
        $codeId =  getCodeNextId($request->table,$request->title);
        return response()->json( array('success' => true,'code' => $codeId));
    })->name('build.code');

    //Autocomplete
    Route::post('autocomplete/reorders', function (Request $request) {
        return getItemAutocomplete($request);
    })->name('reorders.autocomplete');

    //Overview
    Route::match(['get', 'post'], 'overviews/{overview?}', [OverviewController::class,'index'])->name('overviews');
    Route::post('overviews/update/inventory',[OverviewController::class,'update'])->name('overviews.update.inventory');
    Route::delete('overviews/delete}',[OverviewController::class,'destroy'])->name('overviews.delete');

});

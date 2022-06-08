<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;

Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    //  Users
    Route::match(['get', 'post'], 'users/{user?}', [UserController::class,'index'])->name('users');
    Route::get('users/profile/{user}',[UserController::class,'profile'])->name('users.profile');

    Route::post('users/edit/{user}',[UserController::class,'edit'])->name('users.edit');
    Route::get('users/delete',[UserController::class,'destroy'])->name('users.delete');
    Route::post('users/delete/checkbox',[UserController::class,'destroyCheckbox'])->name('users.delete.checkbox');
    Route::any('users/detail/{user}',[UserController::class,'detail'])->name('users.detail');

    //permission
    Route::put('users/password/{user}',[UserController::class,'password'])->name('users.password');
    Route::post('users/permission/{user}',[PermissionController::class,'store'])->name('permission.update');
    Route::post('users/checkbox/permission',[PermissionController::class,'permission'])->name('users.permission.checkbox');

    //User Import & Export and PDF
    Route::post('users/import/profile',[UserController::class,'import'])->name('users.import');
    Route::post('users/export/profile',[UserController::class,'export'])->name('users.export');
    Route::get('users/print/profile',[UserController::class,'printPdf'])->name('users.print');

    //Personal Info
    Route::post('users/info/{user}',[UserController::class,'infoEdit'])->name('users.edit.info');
});

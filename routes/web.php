<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\PetisiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/id');

Route::group(['prefix' => '{locale}'], function () {
    Route::get('/', [IndexController::class, 'welcome'])->name('welcome');
    Route::get('/login', [IndexController::class, 'viewmasuk'])->name('viewmasuk');
    Route::get('/register', [IndexController::class, 'viewdaftar'])->name('viewdaftar');

    Route::post('/login-post', [UserController::class, 'login'])->name('login');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/register-post', [UserController::class, 'register'])->name('register');
    Route::get('/mulaipetisi', [UserController::class, 'mulaiview'])->name('mulaiview');
    Route::post('/dukungpetisi', [UserController::class, 'dukungpetisi'])->middleware('user')->name('dukungpetisi');
    Route::get('/petisisaya', [UserController::class, 'petisisaya'])->middleware('user')->name('petisisaya');
    Route::get('/viewprofil', [UserController::class, 'viewprofil'])->middleware('user')->name('viewprofil');
    Route::post('/editprofil', [UserController::class, 'editprofil'])->middleware('user')->name('editprofil');

    Route::get('/direktori', [PetisiController::class, 'semuapetisi'])->middleware('admin')->name('direktori');
    Route::get('/semuapetisi', [PetisiController::class, 'semuapetisi'])->name('semuapetisi');
    Route::post('/insertpetisi', [PetisiController::class, 'insertpetisi'])->middleware('user')->name('insertpetisi');
    Route::get('/{petisi:slugpet?}', [PetisiController::class, 'detailpetisi'])->name('detailpetisi');
    Route::get('/delete/{petisi:id?}', [PetisiController::class, 'hapuspetisi'])->name('hapuspetisi');
    Route::get('/deleteadmin/{petisi:id?}', [PetisiController::class, 'hapuspetisiadmin'])->middleware('admin')->name('hapuspetisiadmin');
});

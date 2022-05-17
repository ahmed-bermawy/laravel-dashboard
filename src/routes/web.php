<?php

use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\Auth\ConfirmPasswordController;
use App\Http\Controllers\dashboard\Auth\ForgotPasswordController;
use App\Http\Controllers\dashboard\Auth\LoginController;
use App\Http\Controllers\dashboard\Auth\ResetPasswordController;
use App\Http\Controllers\dashboard\BackendProductController;
use App\Http\Controllers\dashboard\DashboardHomeController;
use App\Http\Controllers\dashboard\PermissionController;
use App\Http\Controllers\dashboard\RoleController;
use Illuminate\Support\Facades\Route;

Route::prefix('dashboard')->group(function () {

    Route::group(['middleware' => 'web'], function () {
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    });

    Route::middleware(['web', 'guest'])->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login']);
    });

    Route::middleware(['web', 'auth:admin'])->group(function () {

        Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
        Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);


        Route::get('/home', [DashboardHomeController::class, 'index'])->name('home');
        Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::resource('admins', AdminController::class);
        Route::post('admins/change_password', [AdminController::class, 'changePassword'])->name('admins.changePassword');

        Route::resource('roles', RoleController::class);

        Route::get('permissions/sort', [PermissionController::class, 'sort']);
        Route::post('permissions/saveOrder', [PermissionController::class, 'saveOrder']);
        Route::resource('permissions', PermissionController::class);

        Route::resource('backendproducts', BackendProductController::class);

    });
});

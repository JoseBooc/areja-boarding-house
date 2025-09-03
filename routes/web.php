<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\RoomAssignmentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/dashboard/staff', [DashboardController::class, 'staff'])->name('dashboard.staff');
    Route::get('/dashboard/tenant', [DashboardController::class, 'tenant'])->name('dashboard.tenant');

    Route::middleware('can:tenant-self')->group(function () {
        Route::view('/tenant/utilities', 'tenant.utilities')->name('tenant.utilities');
        Route::view('/tenant/rent', 'tenant.rent')->name('tenant.rent');
    });
});

Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserManagementController::class, 'create'])->name('users.create');
    Route::post('/users', [UserManagementController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserManagementController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserManagementController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserManagementController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth', 'can:manage-tenants'])->group(function () {
    Route::get('/tenants', [TenantController::class, 'index'])->name('tenants.index');
    Route::get('/tenants/{tenant}/edit', [TenantController::class, 'edit'])->name('tenants.edit');
    Route::put('/tenants/{tenant}', [TenantController::class, 'update'])->name('tenants.update');

    Route::get('/tenants/{tenant}/assign', [RoomAssignmentController::class, 'assignForm'])->name('tenants.assign.form');
    Route::post('/tenants/{tenant}/assign', [RoomAssignmentController::class, 'assign'])->name('tenants.assign');
});

Route::get('/rooms/availability', [RoomController::class, 'availability'])->name('rooms.availability');
Route::middleware(['auth', 'can:view-repairs'])->get('/rooms/repairs', [RoomController::class, 'repairs'])->name('rooms.repairs');

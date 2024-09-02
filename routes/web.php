<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dumas\DumasController;
use App\Http\Controllers\Document\DocumentController;
use App\Http\Controllers\Log\LogController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\User\UserController;

// Routing
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login-process', [AuthController::class, 'login'])->name('login.action');

Route::middleware(['auth', 'auth.session'])->group(function () {
  // logs
  Route::get('auth-logs', [LogController::class, 'logs'])->middleware('check.access:administrator')->name('auth.logs')->middleware('log.activity');
  Route::post('auth-logs/list', [LogController::class, 'authList'])->middleware('check.access:administrator')->name('auth.list');
  Route::get('log-activity', [LogController::class, 'LogActivity'])->middleware('check.access:administrator')->name('log.activity')->middleware('log.activity');
  Route::post('log-activity/list', [LogController::class, 'activityList'])->middleware('check.access:administrator')->name('log.activityList');

  Route::get('/', [DashboardController::class, 'index'])->middleware('log.activity')->name('dashboard');

  Route::prefix('data')->group(function () {
    Route::get('jadwal', [DashboardController::class, 'getJadwal'])->name('data.jadwal');
  })->middleware('log.activity');
  Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('log.activity');

  // User
  Route::get('/user', [UserController::class, 'UserManagement'])->middleware(['check.access:administrator', 'log.activity'])->name('user');
  Route::resource('/user-list', UserController::class);
  Route::prefix('profile')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('profile');
    Route::get('edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('security', [ProfileController::class, 'security'])->name('profile.security');
    Route::post('security', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
  })->middleware('log.activity');

  // Dumas
  Route::prefix('dumas')->group(function () {
    Route::get('/', [DumasController::class, 'index'])->name('dumas');
    Route::get('create', [DumasController::class, 'create'])->name('dumas.create');
    Route::post('create', [DumasController::class, 'store'])->name('dumas.store');
    Route::get('show/{id}', [DumasController::class, 'show'])->name('dumas.show');
    Route::get('edit/{id}', [DumasController::class, 'edit'])->name('dumas.edit');
    Route::put('update/{id}', [DumasController::class, 'update'])->name('dumas.update');
    Route::delete('delete/{id}', [DumasController::class, 'destroy'])->name('dumas.destroy');
    Route::post('{id}', [DumasController::class, 'markDone'])->name('dumas.markDone');
    Route::get('history', [DumasController::class, 'history'])->name('dumas.history');
    Route::post('transaction/{id}', [DumasController::class, 'transaction'])->name('dumas.transaction');
    Route::post('progress/{id}', [DumasController::class, 'progress'])->name('progress.add');
    Route::delete('progress/{id}', [DumasController::class, 'progress_destroy'])->name('progress.destroy');
    Route::post('end/{id}', [DumasController::class, 'endDumas'])->name('dumas.end');

    Route::delete('witness/{id}', [DumasController::class, 'deleteWitness'])->name('dumas.deleteWitness');
    Route::delete('evidence/{id}', [DumasController::class, 'deleteEvidence'])->name('dumas.deleteEvidence');

    Route::post('document/{id}', [DocumentController::class, 'store'])->name('document.store');
    Route::delete('document/{id}', [DocumentController::class, 'deleteDoc'])->name('document.destroy');

    Route::post('arsip/{id}', [DocumentController::class, 'arsip'])->name('document.arsip');
  })->middleware('log.activity');
});
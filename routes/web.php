<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\Admin\ExpenseCategoryController;

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

Route::get('/', function () {
    return redirect()->route('login');
})->middleware('redirect.home');

//Admin
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::post('status-change-expense-category', [ExpenseCategoryController::class, 'updateExpenseCategoryStatus'])->name('update.expense.category.status');


        Route::resource('expense-categories', ExpenseCategoryController::class);
        // Route::resource('income-categories', \App\Http\Controllers\Admin\IncomeCategoryController::class);
    });

//User
Route::middleware(['auth', 'role:user'])
    // ->prefix('user')
    ->name('user.')
    ->group(function () {

        Route::get('/dashboard', [UserDashboardController::class, 'index'])
            ->name('dashboard');

        // Route::resource('wallets', \App\Http\Controllers\User\WalletController::class);

        // Route::resource('transactions', \App\Http\Controllers\User\TransactionController::class);
    });
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\SettlementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('groups', GroupController::class);
    
    Route::get('/groups/{group}/members', [MemberController::class, 'index'])->name('groups.members');
    Route::post('/groups/{group}/members', [MemberController::class, 'store'])->name('groups.members.store');
    Route::delete('/groups/{group}/members/{user}', [MemberController::class, 'destroy'])->name('groups.members.destroy');

    Route::resource('groups.expenses', ExpenseController::class);
    Route::get('/groups/{group}/balances', [BalanceController::class, 'show'])->name('groups.balances');

    Route::get('/groups/{group}/settlements', [SettlementController::class, 'index'])
        ->name('groups.settlements.index');
    Route::post('/groups/{group}/settlements', [SettlementController::class, 'store'])
        ->name('groups.settlements.store');
    Route::delete('/groups/{group}/settlements/{settlement}', [SettlementController::class, 'destroy'])
        ->name('groups.settlements.destroy');
    
});

require __DIR__.'/auth.php';

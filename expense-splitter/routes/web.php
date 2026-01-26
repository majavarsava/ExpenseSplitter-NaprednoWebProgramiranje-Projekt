<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
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
});

require __DIR__.'/auth.php';

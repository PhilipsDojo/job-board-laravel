<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;

// Resource-Routen (müssen VOR der Startseite stehen, aber das ist egal)
Route::resource('categories', CategoryController::class);
Route::resource('companies', CompanyController::class);
Route::resource('jobs', JobController::class);
Route::resource('user', UserController::class);

// Deine Startseite mit Daten
Route::get('/', function () {
    $companies = Company::all();
    $jobs = Job::all();
    $user = User::all(); // Singular!
    $categories = Category::all();

    return view('welcome', compact('companies', 'jobs', 'user', 'categories'));
})->name('home');

// Dashboard (nur für eingeloggte)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Auth-Routen (Profil etc.)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
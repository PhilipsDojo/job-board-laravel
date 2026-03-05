<?php

use Illuminate\Support\Facades\Route;

// import erstelle Models in web.php für view:
use App\Models\Company;
use App\Models\Job;
use App\Models\User;
use App\Models\Category;
use App\Http\Controllers\CategoryController;

Route::resource('categories', CategoryController::class);

Route::get('/', function () {
    /* laravel DEMO
    return view('welcome');
    */

    // hole alle Daten aus den bestehenden Models
    $companies = Company::all();
    $jobs = Job::all();
    $users = User::all();
    $categories = Category::all();

    // gib die Daten in den View:
    return view('welcome', compact('companies', 'jobs', 'users','categories'));
    
});

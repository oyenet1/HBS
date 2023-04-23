<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    if (Auth::check()) {
        return toDashboard();
    }
    return view('auth.login');
});

Route::view('/sales', 'layouts.dashboard');

/* ----------------admin only route ------------*/
Route::group(['prefix' => 'consultations', 'middleware' => ['auth', 'role:superadmin|administrator']], function () {
    Route::get('/patients', \App\Http\Livewire\Patients\Index::class)->name('patients.index');
    Route::get('/inventories', \App\Http\Livewire\Inventory\Index::class)->name('inventories.index');
    Route::get('/doctors', \App\Http\Livewire\Users::class)->name('doctors');
});

Route::get('/administrator/home', App\Http\Livewire\AdminDashboard::class)->middleware('role:superadmin|administrator');


Route::get('/home', function () {
    return toDashboard();
})->name('home')->middleware('auth');
Route::get('/profile', App\Http\Livewire\ImageUpload::class)->name('profile')->middleware('auth');
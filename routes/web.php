<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Dashboard\Tasks\Index;
use App\Http\Livewire\Dashboard\Tasks\Manage;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group([
    'middleware' => ['auth', 'verified'],
], function () {
    Route::group([
        'prefix' => 'dashboard',
        'as' => 'dashboard.',
    ], function () {
        Route::view('/', 'dashboard')->name('index');
        Route::get('/tasks', Index::class)->name('tasks.index');
        Route::get('/tasks/manage/{task?}', Manage::class)->name('tasks.manage');
    });
});

require __DIR__.'/auth.php';

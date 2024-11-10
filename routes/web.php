<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubjectController;
use App\Models\Subject;
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

Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');


Route::prefix('subject')->group(function () {
    Route::get('/', [SubjectController::class, 'index'])->name('admin.subject.index');
    Route::get('/create', [SubjectController::class, 'create'])->name('admin.subject.create');
    Route::post('/', [SubjectController::class, 'store'])->name('subject.store');
    Route::get('/{id}', [SubjectController::class, 'show'])->name('subject.show');
    Route::get('/{id}/edit', [SubjectController::class, 'edit'])->name('admin.subject.edit');
    Route::put('/{id}', [SubjectController::class, 'update'])->name('subject.update');
    Route::delete('/{id}', [SubjectController::class, 'destroy'])->name('subject.destroy');
});

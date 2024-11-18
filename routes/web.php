<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TaskController;
use App\Models\Subject;
use App\Models\Task;
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

Route::prefix('task')->group(function () {
    Route::get('/', [TaskController::class, 'index'])->name('admin.task.index');
    Route::get('/create', [TaskController::class, 'create'])->name('admin.task.create');
    Route::post('/', [TaskController::class, 'store'])->name('task.store');
    Route::get('/{id}', [TaskController::class, 'show'])->name('task.show');
    Route::get('/{id}/edit', [TaskController::class, 'edit'])->name('admin.task.edit');
    Route::put('/{id}', [TaskController::class, 'update'])->name('task.update');
    Route::delete('/{id}', [TaskController::class, 'destroy'])->name('task.destroy');
});


Route::prefix('note')->group(function () {
    Route::get('/', [NoteController::class, 'index'])->name('admin.note.index');
    Route::get('/create', [NoteController::class, 'create'])->name('admin.note.create');
    Route::post('/', [NoteController::class, 'store'])->name('note.store');
    Route::get('/{id}', [NoteController::class, 'show'])->name('note.show');
    Route::get('/{id}/edit', [NoteController::class, 'edit'])->name('admin.note.edit');
    Route::put('/{id}', [NoteController::class, 'update'])->name('note.update');
    Route::delete('/{id}', [NoteController::class, 'destroy'])->name('note.destroy');
});

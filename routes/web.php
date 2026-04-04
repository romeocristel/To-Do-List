<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\Task;

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect('/');
    })->name('dashboard');

    Route::get('/profile', function () {
        return redirect('/');
    })->name('profile.edit');

    Route::patch('/profile', function () {
        return redirect('/');
    })->name('profile.update');

    Route::delete('/profile', function () {
        return redirect('/');
    })->name('profile.destroy');

    Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');        
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update'); 
    Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

});

require __DIR__.'/auth.php';
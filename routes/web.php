<?php
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[TaskController::class,'index'])->name('tasks.index');
Route::get('/tasks',[TaskController::class,'index'])->name('tasks.index');



Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Protected Routes (Dashboard)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/tasks/create',[TaskController::class,'create'])->name('tasks.create');
    Route::post('/tasks/store',[TaskController::class,'store'])->name('tasks.store');

Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
// The {id} here catches the ID you passed in the form action
Route::put('/tasks/{id}', [App\Http\Controllers\TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/delete/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');
Route::patch('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
});
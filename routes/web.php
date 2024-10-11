<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ReportControllerr;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Models\Project;
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
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [TaskController::class, 'index'])->name('home');

Route::resource('projects', ProjectController::class)->middleware('auth');
Route::resource('users', UserController::class);
Route::resource('tasks', TaskController::class);
Route::resource('reports', ReportControllerr::class);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.delete');
Route::get('/logout', [TaskController::class, 'logout']);
Route::post('/time-calculation', [TaskController::class, 'timerStore'])->name('time');


Route::get('task-board', [TaskController::class, 'taskBoard'])->name('task-board');

// Route::resource('tasks', TaskController::class)->middleware('auth');

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});










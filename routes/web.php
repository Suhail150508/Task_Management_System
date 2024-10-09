<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
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

Route::get('/home', [TaskController::class, 'index'])->name('home');

Route::resource('projects', ProjectController::class)->middleware('auth');
Route::resource('tasks', TaskController::class);
Route::delete('/tasks/{id}', [TaskController::class, 'delete'])->name('tasks.delete');
Route::resource('users', UserController::class);



Route::get('task-board', [TaskController::class,'taskBoard']);
// Route::resource('tasks', TaskController::class)->middleware('auth');

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});










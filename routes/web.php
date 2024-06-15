<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
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

# Testing App For Both Firestore and Realtime database of Firebase (Google)
Route::get('/', function () {
    return view('welcome');
});

Route::get('users/index', [UserController::class, 'index']);
Route::get('users/create', [UserController::class, 'create']);
Route::get('users/update', [UserController::class, 'update']);
Route::get('users/show', [UserController::class, 'show']);
Route::get('users/delete', [UserController::class, 'destroy']);

Route::get('students/index', [StudentController::class, 'index']);
Route::get('students/create', [StudentController::class, 'create']);
Route::get('students/update', [StudentController::class, 'update']);
Route::get('students/show', [StudentController::class, 'show']);
Route::get('students/delete', [StudentController::class, 'destroy']);

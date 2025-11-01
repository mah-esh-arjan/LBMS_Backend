<?php

use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\RegisterAPIController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DummyAPIController;
use App\Http\Controllers\API\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("data", [DummyAPIController::class, 'getData']);

Route::post("createMovie", [DummyAPIController::class, 'postData']);

Route::get('/get-movie/{id}', [DummyAPIController::class, 'getMovie']);


Route::post('/login', [AuthController::class, 'login']);
Route::get('/users', [AuthController::class, 'getUser']);
Route::delete('/users/{id}', [AuthController::class, 'deleteUser']);
Route::get('/restore/{id}',  [AuthController::class, 'restore']);

Route::post('/user-register', [RegisterAPIController::class, 'store']);


// student related routes
Route::post('/student-register', [StudentController::class, 'registerStudent']);
Route::post('/student-login', [StudentController::class, 'loginStudent']);

// proctected route accessible by admin token and student token
Route::middleware(['auth:sanctum', 'checkAbilities:student-access,admin-access'])->group(function () {

    Route::get('/student-book-list/{student_id}', [StudentController::class, 'getStudentBooks']);
    Route::get('/student-book/{student_id}', [StudentController::class, 'getRentBooks']);
    Route::post('/student-book/{student_id}', [StudentController::class, 'rentBook']);
    Route::get('/students-show/{student_id}', [AdminController::class, 'showStudent']);
    Route::put('/student-update/{student_id}', [AdminController::class, 'updateStudent']);
});

// admin related routes

Route::post('/admin-register', [AdminController::class, 'registerAdmin']);
Route::post('/admin-login', [AdminController::class, 'adminLogin']);

// protected only by admin token
Route::middleware(['auth:sanctum', 'ability:admin-access'])->group(function () {
    Route::get('/students-list', [AdminController::class, 'getStudents']);
    Route::delete('/student-delete/{student_id}', [AdminController::class, 'deleteStudent']);
    Route::get('/books-list', [BookController::class, 'getBooks']);
    Route::post('/book-create', [BookController::class, 'createBook']);
    Route::get('/book-show/{id}', [BookController::class, 'showBook']);
    Route::put('/book-update/{id}', [BookController::class, 'updateBook']);
    Route::delete('/book-delete/{id}', [BookController::class, 'deleteBook']);
});

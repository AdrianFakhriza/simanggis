<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StatisticsController;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ClassesController;
use App\Http\Controllers\Api\FeedbackController;
use App\Http\Controllers\Api\MealCheckController;
use App\Http\Controllers\Api\MealDistributionController;
use App\Http\Controllers\Api\SchoolController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/statistics', [StatisticsController::class,'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/schoolsPublic', [SchoolController::class, 'publicIndex']);
Route::get('/schoolsPublic/{id}', [SchoolController::class, 'publicShow']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
    Route::apiResource('classes', ClassesController::class);
    Route::apiResource('feedback', FeedbackController::class);
    Route::apiResource('meal-check', MealCheckController::class)->only(['index', 'show', 'store']);
    Route::apiResource('meal-distribution', MealDistributionController::class)->only (['index','store'])  ;
    Route::apiResource('schools', SchoolController::class);
    Route::apiResource('students', StudentController::class);
    Route::apiResource('teachers', TeacherController::class);
});

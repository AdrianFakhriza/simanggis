<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    ProfileController,
    SchoolController,
    StudentController,
    MealDistributionController,
    FeedbackController,
    ClassesController,
    TeacherController,
    AdminController,
    MealCheckController
};

// -----------------------------
// Public Routes
// -----------------------------
Route::get('/', function () {
    return view('home');
});

Route::view('/teams', 'teams')->name('teams');

// -----------------------------
// Authenticated & Verified Routes
// -----------------------------
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Profile
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// -----------------------------
// Admin Only Routes
// -----------------------------
Route::middleware(['auth', 'checkRole:admin'])->prefix('admin')->group(function () {
    // SCHOOL DATA
    Route::get('/school', [SchoolController::class, 'index'])->name('school.data');
    Route::get('/school/detail', [SchoolController::class, 'showEditForm'])->name('school.detail');
    Route::put('/school/detail', [SchoolController::class, 'update'])->name('school.update');

    // TEACHERS
    Route::prefix('teachers')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('teachers');
        Route::get('/add', [TeacherController::class, 'create'])->name('teachers.addForm');
        Route::post('/add', [TeacherController::class, 'store'])->name('teachers.addData');
        Route::get('/edit/{id}', [TeacherController::class, 'edit'])->name('teachers.editForm');
        Route::put('/edit/{id}', [TeacherController::class, 'update'])->name('teachers.editData');
        Route::delete('/delete/{id}', [TeacherController::class, 'destroy'])->name('teachers.deleteData');
        Route::get('/detail/{id}', [TeacherController::class, 'show'])->name('teachers.detail');
    });

    // STUDENTS DATA
    Route::get('/students', [StudentController::class, 'index'])->name('students');
    Route::get('/students/add', [StudentController::class, 'create'])->name('students.addForm');
    Route::post('/students/add', [StudentController::class, 'store'])->name('students.addData');
    Route::get('/students/edit/{id}', [StudentController::class, 'edit'])->name('students.editForm');
    Route::put('/students/edit/{id}', [StudentController::class, 'update'])->name('students.editData');
    Route::delete('/students/delete/{id}', [StudentController::class, 'destroy'])->name('students.deleteData');
    Route::get('/students/show/{id}', [StudentController::class, 'show'])->name('students.show');

    // CLASSES
    Route::prefix('class')->group(function () {
        Route::get('/', [ClassesController::class, 'index'])->name('class');
        Route::get('/add', [ClassesController::class, 'create'])->name('class.add');
        Route::post('/add', [ClassesController::class, 'store'])->name('class.addData');
        Route::get('/edit/{id}', [ClassesController::class, 'edit'])->name('class.edit');
        Route::put('/edit/{id}', [ClassesController::class, 'update'])->name('class.update');
        Route::delete('/delete/{id}', [ClassesController::class, 'destroy'])->name('class.delete');
        Route::get('/detail/{id}', [ClassesController::class, 'show'])->name('class.detail');
    });
});

// -----------------------------
// Guru Only Routes
// -----------------------------
Route::middleware(['auth', 'checkRole:guru'])->prefix('teacher')->group(function () {
    // Tambahkan route khusus guru di sini
    Route::get('/meal-check', [MealCheckController::class, 'index'])->name('meal.check.index');
    Route::get('meal_check/{class_id}/{meal_date}', [MealCheckController::class, 'show'])->name('meal_check.absen');
    Route::post('meal_check/absen', [MealCheckController::class, 'store'])->name('meal_check.absen.store');
});

// -----------------------------
// Admin & Operator Routes
// -----------------------------
Route::middleware(['auth', 'checkRole:admin,operator'])->prefix('meals')->group(function () {
    Route::get('/', [MealDistributionController::class, 'index'])->name('meals');
    Route::get('/create', [MealDistributionController::class, 'create'])->name('meals.create');
    Route::post('/create', [MealDistributionController::class, 'store'])->name('meals.store');
});


// -----------------------------
// Auth scaffolding routes
// -----------------------------
require __DIR__ . '/auth.php';

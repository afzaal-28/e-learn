<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserStatsController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\AdminAuth\LoginController;
use App\Http\Controllers\Admin\CourseStatsController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ChatController as AdminChatController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::prefix('admin')->group(function(){
    Route::get('/login', [LoginController::class, 'create'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    Route::middleware(AdminAuth::class)->group(function () {
        #Chats
        Route::resource('chats', AdminChatController::class)->names('admin.chats');
        #others
        Route::get('/admin/permissions', [HomeController::class, 'getPermissions'])->middleware('auth:admin');
        Route::resource('/', HomeController::class)->names('admin')->only(['index']);
        #course
        Route::resource('courses', AdminCourseController::class)->names('admin.courses');
        #profile
        Route::get('/profile', [AdminProfileController::class, 'show'])->name('admin.profile');
        Route::patch('/profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
        Route::delete('/profile', [AdminProfileController::class, 'destroy'])->name('admin.profile.delete');
        #student
        Route::resource('student', StudentController::class);
        #stats
        Route::get('/admin/courses-stats', [CourseStatsController::class, 'index']);   
        Route::get('/admin/user-stats', [UserStatsController::class, 'index'])->name('admin.userStats');
    });
});

Route::get('/dashboard', function () {
    return Inertia::render('User/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    #profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    #courses
    Route::get('/courses', function () { return Inertia::render('User/Courses/Index'); })->name('user.courses');
});

require __DIR__.'/auth.php';

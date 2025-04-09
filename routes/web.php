<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!\
|
*/

Route::get('/', [JobController::class, 'dashboard'])->name('dashboard'); // Define this route
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin', [AdminAuthController::class, 'login']);

// Job routes
Route::middleware(['auth'])->group(function () {
    Route::get('/my-applications', [ApplicationController::class, 'myApplications'])->name('my.applications');
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'apply'])->name('jobs.apply');
    Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create'); // Route to create a new job
    Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store'); // Route to store the new job
    Route::post('/jobs/{job}/apply', [ApplicationController::class, 'apply'])->name('jobs.apply');
});

// Application routes
Route::middleware(['auth'])->group(function () {
    Route::get('/applications/{application}/edit', [ApplicationController::class, 'edit'])->name('applications.edit');
    Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
    Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');
});
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/jobs', [AdminController::class, 'jobs'])->name('admin.jobs');
    Route::get('/applications', [AdminController::class, 'applications'])->name('admin.applications');
    Route::get('/admin/jobs/{job}/edit', [JobController::class, 'edit'])->name('admin.jobs.edit');
    Route::put('/admin/jobs/{job}', [JobController::class, 'update'])->name('admin.jobs.update');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/jobs', [AdminJobController::class, 'index'])->name('admin.jobs.index');
    Route::get('/jobs/create', [AdminJobController::class, 'create'])->name('jobs.create');
    Route::post('/jobs', [AdminJobController::class, 'store'])->name('admin.jobs.store');
});
require __DIR__ . '/auth.php';

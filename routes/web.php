<?php

use App\Http\Controllers\Ajax\DashboardController as AjaxDashboardController;
use App\Http\Controllers\Ajax\LocationController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\LecturerController;
use App\Http\Controllers\Backend\MajorController;
use App\Http\Controllers\Backend\PositionController;
use App\Http\Controllers\Backend\SchoolYearController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\StudentGroupController;
use App\Http\Controllers\Backend\TopicCatalogueController;
use App\Http\Controllers\Backend\TopicController;
use App\Http\Controllers\Backend\UserCatalogueController;
use App\Http\Controllers\Backend\UserController;
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

Route::get('', [DashboardController::class, 'index'])->name('index')->middleware('admin');
Route::get('dashboard/index', [DashboardController::class, 'index'])->name('index')->middleware('admin');


Route::group(['prefix' => 'user'], function () {
    Route::get('index', [UserController::class, 'index'])->name('user.index')->middleware('admin');
    Route::get('create', [UserController::class, 'create'])->name('user.create');
    Route::post('create', [UserController::class, 'store'])->name('user.store');
    Route::get('edit/{id}', [UserController::class, 'edit'])->where(['id' => '[0-9]+'])->name('user.edit');
    Route::post('edit/{id}', [UserController::class, 'update'])->where(['id' => '[0-9]+'])->name('user.update');
    Route::get('delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::group(['prefix' => 'lecturer'], function () {
    Route::get('index', [LecturerController::class, 'index'])->name('lecturer.index')->middleware('admin');
    Route::get('create', [LecturerController::class, 'create'])->name('lecturer.create');
    Route::post('create', [LecturerController::class, 'store'])->name('lecturer.store');
    Route::get('edit/{id}', [LecturerController::class, 'edit'])->where(['id' => '[0-9]+'])->name('lecturer.edit');
    Route::post('edit/{id}', [LecturerController::class, 'update'])->where(['id' => '[0-9]+'])->name('lecturer.update');
    Route::get('delete/{id}', [LecturerController::class, 'destroy'])->name('lecturer.destroy');
});

Route::group(['prefix' => 'student'], function () {
    Route::get('index', [StudentController::class, 'index'])->name('student.index')->middleware('admin');
    Route::get('create', [StudentController::class, 'create'])->name('student.create');
    Route::post('create', [StudentController::class, 'store'])->name('student.store');
    Route::get('edit/{id}', [StudentController::class, 'edit'])->where(['id' => '[0-9]+'])->name('student.edit');
    Route::post('edit/{id}', [StudentController::class, 'update'])->where(['id' => '[0-9]+'])->name('student.update');
    Route::get('delete/{id}', [StudentController::class, 'destroy'])->name('student.destroy');
});

Route::group(['prefix' => 'user_catalogue'], function () {
    Route::get('index', [UserCatalogueController::class, 'index'])->name('userCatalogue.index')->middleware('admin');
    Route::get('create', [UserCatalogueController::class, 'create'])->name('userCatalogue.create');
    Route::post('create', [UserCatalogueController::class, 'store'])->name('userCatalogue.store');
    Route::get('edit/{id}', [UserCatalogueController::class, 'edit'])->where(['id' => '[0-9]+'])->name('userCatalogue.edit');
    Route::post('edit/{id}', [UserCatalogueController::class, 'update'])->where(['id' => '[0-9]+'])->name('userCatalogue.update');
    Route::get('delete/{id}', [UserCatalogueController::class, 'destroy'])->name('userCatalogue.destroy');
});

Route::group(['prefix' => 'department'], function () {
    Route::get('index', [DepartmentController::class, 'index'])->name('department.index')->middleware('admin');
    Route::get('create', [DepartmentController::class, 'create'])->name('department.create');
    Route::post('create', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('edit/{id}', [DepartmentController::class, 'edit'])->where(['id' => '[0-9]+'])->name('department.edit');
    Route::post('edit/{id}', [DepartmentController::class, 'update'])->where(['id' => '[0-9]+'])->name('department.update');
    Route::get('delete/{id}', [DepartmentController::class, 'destroy'])->name('department.destroy');
});

Route::group(['prefix' => 'major'], function () {
    Route::get('index', [MajorController::class, 'index'])->name('major.index')->middleware('admin');
    Route::get('create', [MajorController::class, 'create'])->name('major.create');
    Route::post('create', [MajorController::class, 'store'])->name('major.store');
    Route::get('edit/{id}', [MajorController::class, 'edit'])->where(['id' => '[0-9]+'])->name('major.edit');
    Route::post('edit/{id}', [MajorController::class, 'update'])->where(['id' => '[0-9]+'])->name('major.update');
    Route::get('delete/{id}', [MajorController::class, 'destroy'])->name('major.destroy');
});

Route::group(['prefix' => 'school_year'], function () {
    Route::get('index', [SchoolYearController::class, 'index'])->name('school_year.index')->middleware('admin');
    Route::get('create', [SchoolYearController::class, 'create'])->name('school_year.create');
    Route::post('create', [SchoolYearController::class, 'store'])->name('school_year.store');
    Route::get('edit/{id}', [SchoolYearController::class, 'edit'])->where(['id' => '[0-9]+'])->name('school_year.edit');
    Route::post('edit/{id}', [SchoolYearController::class, 'update'])->where(['id' => '[0-9]+'])->name('school_year.update');
    Route::get('delete/{id}', [SchoolYearController::class, 'destroy'])->name('school_year.destroy');
});

Route::group(['prefix' => 'position'], function () {
    Route::get('index', [PositionController::class, 'index'])->name('position.index')->middleware('admin');
    Route::get('create', [PositionController::class, 'create'])->name('position.create');
    Route::post('create', [PositionController::class, 'store'])->name('position.store');
    Route::get('edit/{id}', [PositionController::class, 'edit'])->where(['id' => '[0-9]+'])->name('position.edit');
    Route::post('edit/{id}', [PositionController::class, 'update'])->where(['id' => '[0-9]+'])->name('position.update');
    Route::get('delete/{id}', [PositionController::class, 'destroy'])->name('position.destroy');
});

Route::group(['prefix' => 'student_group'], function () {
    Route::get('index', [StudentGroupController::class, 'index'])->name('student_group.index')->middleware('admin');
    Route::get('create', [StudentGroupController::class, 'create'])->name('student_group.create');
    Route::post('create', [StudentGroupController::class, 'store'])->name('student_group.store');
    Route::get('edit/{id}', [StudentGroupController::class, 'edit'])->where(['id' => '[0-9]+'])->name('student_group.edit');
    Route::post('edit/{id}', [StudentGroupController::class, 'update'])->where(['id' => '[0-9]+'])->name('student_group.update');
    Route::get('delete/{id}', [StudentGroupController::class, 'destroy'])->name('student_group.destroy');
});

Route::group(['prefix' => 'topic_catalogue'], function () {
    Route::get('index', [TopicCatalogueController::class, 'index'])->name('topicCatalogue.index')->middleware('admin');
    Route::get('create', [TopicCatalogueController::class, 'create'])->name('topicCatalogue.create');
    Route::post('create', [TopicCatalogueController::class, 'store'])->name('topicCatalogue.store');
    Route::get('edit/{id}', [TopicCatalogueController::class, 'edit'])->where(['id' => '[0-9]+'])->name('topicCatalogue.edit');
    Route::post('edit/{id}', [TopicCatalogueController::class, 'update'])->where(['id' => '[0-9]+'])->name('topicCatalogue.update');
    Route::get('delete/{id}', [TopicCatalogueController::class, 'destroy'])->name('topicCatalogue.destroy');
});

Route::group(['prefix' => 'topic'], function () {
    Route::get('index', [TopicController::class, 'index'])->name('topic.index')->middleware('admin');
    Route::get('create', [TopicController::class, 'create'])->name('topic.create');
    Route::post('create', [TopicController::class, 'store'])->name('topic.store');
    Route::get('edit/{id}', [TopicController::class, 'edit'])->where(['id' => '[0-9]+'])->name('topic.edit');
    Route::post('edit/{id}', [TopicController::class, 'update'])->where(['id' => '[0-9]+'])->name('topic.update');
    Route::get('delete/{id}', [TopicController::class, 'destroy'])->name('topic.destroy');
});

// Ajax
Route::get('ajax/location/getLocation', [LocationController::class, 'getLocation'])->name('ajax.location.index')->middleware('admin');
Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus')->middleware('admin');
Route::post('ajax/dashboard/changeStatusAll', [AjaxDashboardController::class, 'changeStatusAll'])->name('ajax.dashboard.changeStatusAll')->middleware('admin');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





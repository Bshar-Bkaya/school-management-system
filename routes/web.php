<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Students\FeeController;
use App\Http\Controllers\Quizzes\QuizzController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Students\LibraryController;
use App\Http\Controllers\Students\PaymentController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Questions\QuestionController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\AttendanceController;
use App\Http\Controllers\Students\FeeInvoiceController;
use App\Http\Controllers\Classesrooms\ClassroomController;
use App\Http\Controllers\Students\OnlineClassesController;
use App\Http\Controllers\Students\ProcessingFeeController;
use App\Http\Controllers\Students\ReceiptStudentsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


// Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('selection');
Route::get('/login/{type?}', [LoginController::class, 'loginForm'])->middleware('guest')->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout/{type?}', [LoginController::class, 'logout'])->name('logout');

Route::group(
  [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
  ],
  function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::resource('Grades', GradeController::class);
    // Classrooms
    Route::post('Classroom/deleteall', [ClassroomController::class, 'deleteall'])->name('Classroom.deleteall');
    Route::post('Classroom/filter', [ClassroomController::class, 'filter'])->name('Classroom.filter');
    Route::resource('Classroom', ClassroomController::class);
    // Sections
    Route::resource('Section', SectionController::class);
    // Parents
    Route::view('parents/add', 'livewire.show-form')->name('parents.add');
    // Teachers
    Route::resource('Teachers', TeacherController::class);
    // Students
    Route::get('Student/SoftDelete{id?}', [StudentController::class, 'softDelete'])->name('Student.SoftDelete');
    Route::resource('Students', StudentController::class);
    Route::post('upload/attach', [StudentController::class, 'uploadAttach'])->name('upload.attach');
    Route::get('download/attach/{foldername?}/{filename?}', [StudentController::class, 'downloadAttach'])->name('download.attach');
    Route::get('show/attach/{foldername?}/{filename?}', [StudentController::class, 'showAttach'])->name('show.attach');
    Route::post('delete/attach', [StudentController::class, 'deleteAttach'])->name('delete.attach');
    // Promotions
    Route::resource('Promotions', PromotionController::class);
    // Graduated
    Route::resource('Graduated', GraduatedController::class);
    // Fees
    Route::resource('Fees', FeeController::class);
    // FeesInvoices
    Route::resource('FeesInvoices', FeeInvoiceController::class);
    // Receipt Students
    Route::resource('receipt_students', ReceiptStudentsController::class);
    // Processing Fee
    Route::resource('ProcessingFee', ProcessingFeeController::class);
    // Payments
    Route::resource('Payment_students', PaymentController::class);
    // Attendance
    Route::resource('Attendance', AttendanceController::class);
    // Subjects
    Route::resource('Subjects', SubjectController::class);
    // Quizzes
    Route::resource('Quizzes', QuizzController::class);
    // questions
    Route::resource('questions', QuestionController::class);
    // Library
    Route::resource('library', LibraryController::class);
    Route::get('downloadAttachment/{filename?}', [LibraryController::class, 'downloadAttachment'])->name('downloadAttachment');
    // Online Classes
    Route::resource('online_classes', OnlineClassesController::class);
    // Online Classes indirect.create
    Route::get('indirect_create', [OnlineClassesController::class, 'indirectCreate'])->name('indirect.create.admin');
    // Online Classes indirect.store
    Route::get('indirect_store', [OnlineClassesController::class, 'storeIndirect'])->name('indirect.store.admin');
    // Settings
    Route::resource('settings', SettingController::class);
  }
);

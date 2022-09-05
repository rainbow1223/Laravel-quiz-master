<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\PreviewController;
use App\Http\Controllers\ExamGroupController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\ResultController;

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

Route::get('/', [ExamController::class, 'index']);

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::group(['middleware' => 'role:manager'], function () {
Route::middleware(['role:manager', 'auth'])->group(function() {
    Route::get('/admin', function () {

        return 'Welcome Admin';

    });

    Route::get('/quizes/{quiz_type}/exam/{exam}', [QuizController::class, 'create']);
    Route::get('/quizes/{quiz}', [QuizController::class, 'show']);
    Route::post('/hotspots_image_upload', [QuizController::class, 'hotspots_image_upload']);
    Route::post('/update_quiz_index', [QuizController::class, 'update_quiz_index']);
    Route::post('/duplicate_quiz', [QuizController::class, 'duplicate_quiz']);
    Route::post('/quizes', [QuizController::class, 'store']);
    Route::post('/update_theme_style', [QuizController::class, 'update_theme_style']);
    Route::post('/bg_apply_all', [QuizController::class, 'bg_apply_all']);
    Route::get('/quizes/{quiz}/edit', [QuizController::class, 'edit']);
    Route::put('/quizes/{quiz}', [QuizController::class, 'update']);
    Route::delete('/quizes/{quiz}', [QuizController::class, 'destroy']);
    Route::post('/upload_audio', [UploadController::class, 'upload_audio']);
    Route::post('/upload_video', [UploadController::class, 'upload_video']);
    Route::post('/add_exam_group', [ExamGroupController::class, 'default_store']);
    Route::delete('/exam_groups/{exam_group}', [ExamGroupController::class, 'destroy']);
    Route::post('/delete_selected_users', [UserController::class, 'destroy_selected_users']);
    Route::post('/suspend_selected_users', [UserController::class, 'suspend_selected_users']);
    Route::post('/duplicate_exam', [ExamController::class, 'duplicate_exam'])->name('duplicateExam');
    Route::get('/exam/{id}', [PreviewController::class, 'preview_exam'])->name('preview_exam');
    Route::post('change_password', [UserController::class, 'change_password'])->name('change.password');
});

Route::get('/result/{exam_id}', [ResultController::class, 'show']);

Route::get('/preview_slide/{id}', [PreviewController::class, 'preview_slide']);
Route::get('/preview_group/{id}', [PreviewController::class, 'preview_group']);
Route::get('/examination/{name}', [PreviewController::class, 'exam'])->name('exam');
Route::get('/examRegister', [PreviewController::class, 'startExam'])->name('startExam');


Route::resource('users', UserController::class);
Route::resource('exams', ExamController::class);

Route::post('/send-mail', [SendMailController::class, 'send_mail'])->name('send-mail');


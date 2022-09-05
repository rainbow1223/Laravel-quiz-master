<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ExamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::middleware('auth:api')->get('/get_downloading_quizzes_index', [ExamController::class, 'get_downloading_quizzes_index']);
Route::middleware('auth:api')->get('/get_all_index', [ExamController::class, 'get_all_index']);
Route::middleware('auth:api')->get('/get_quiz/{id}', [ExamController::class, 'get_quiz']);
// Route::middleware('auth:api')->get('/get_base64/{url}', [ExamController::class, 'image_base64']);
// Route::middleware('auth:api')->post('/get_quiz_image_url', [ExamController::class, 'get_image_url_array']);
Route::middleware('auth:api')->post('/get_quiz_video_audio_url', [ExamController::class, 'get_video_audio_url_array']);
Route::middleware('auth:api')->get('/get_quiz_html/{id}', [ExamController::class, 'get_quiz_html']);
Route::post('/send_email', [ExamController::class, 'send_email']);
Route::post('/save_result', [ExamController::class, 'save_result']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

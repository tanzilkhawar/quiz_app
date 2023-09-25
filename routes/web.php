<?php

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

Route::get('/', function () {
    return view('welcome');
});
// routes/web.php

Route::get('/enter-name', 'App\Http\Controllers\UserController@showEnterNameForm')->name('enter-name');
// routes/web.php

Route::post('/save-name', 'App\Http\Controllers\UserController@saveName')->name('save-name');
Route::post('/submit-answer', 'App\Http\Controllers\QuestionController@saveAnswer')->name('submit-answer');
// routes/web.php

Route::get('/questions', 'App\Http\Controllers\QuestionController@index')->name('questions');

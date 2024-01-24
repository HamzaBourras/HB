<?php

use App\Http\Controllers\QCMController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
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
    return view('home',["titre"=>"Home"]);
})->name("home");


Route::prefix('/user')->controller(UserController::class)->name('user.')->group(function () {
    Route::get('/createRegister',"createRegister")->name("createRegister");
    Route::post('/storeRegister',"storeRegister")->name("storeRegister");
    Route::get('/createLogin',"createLogin")->name('createLogin');
    Route::post('/storeLogin',"storeLogin")->name("storeLogin");
    route::get('/logout',"logout")->name('logout')->middleware("auth");
});


Route::prefix('/student')->controller(StudentController::class)->middleware("auth")->name('student.')->group(function () {
    Route::get('/index',"index")->name("index");
    Route::get('/passQcm/{id}',"passQcm")->name('passQcm');
    Route::post('/storeCheckResult',"storeCheckResult")->name("storeCheckResult");
});


Route::prefix('/teacher')->controller(TeacherController::class)->middleware("auth")->name('teacher.')->group(function () {
    Route::get('/index',"index")->name("index");
    Route::get('/createQuestion',"createQuestion")->name("createQuestion");
    Route::post('/storeQuestion',"storeQuestion")->name('storeQuestion');
    Route::get('/createSelectQuestions',"createSelectQuestions")->name("createSelectQuestions");
    Route::post('/storeSelectQuestions',"storeSelectQuestions")->name('storeSelectQuestions');
    Route::post('/storeQcm',"storeQcm")->name('storeQcm');
});


Route::prefix('/qcm')->controller(QCMController::class)->middleware("auth")->name("qcm.")->group(function () {
    Route::get('/showAllQcms',"showAllQcms")->name("showAllQcms");
    Route::get('/showQcm/{id}',"showQcm")->name("showQcm");
});



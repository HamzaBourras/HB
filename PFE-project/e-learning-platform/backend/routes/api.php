<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AuthentificationController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



/********************** Authentification **********************/
Route::post("/login", [AuthentificationController::class, "login"])->name("login");
Route::post("/logout/{user_id}", [AuthentificationController::class, "logout"])->name("logout")->middleware("auth.token");
Route::get("/forgotPassword", [AuthentificationController::class, "forgotPassword"]);


/********************** UpdateProfile **********************/
Route::put("/auth/updateProfile/{user_id}", [AuthentificationController::class, "updateProfile"])->name("updateProfile");


/********************** Director management *************************/

Route::prefix("auth/director/")->controller(DirectorController::class)->middleware("auth.token")->name("director.")->group(function () {

    //--------- - --- Dashbord professors statistics  -----------------------
    Route::get("indexProfessorsStatistics","indexProfStatis")->name("indexProfStatis");

    //--------- - --- professor -----------------------
    Route::prefix("professor/")->name("professor.")->group(function () {
        Route::get("index", "indexProfessor")->name("indexProfessor");
        Route::post("store", "storeProfessor")->name("storeProfessor");
        Route::put("edit/{professor_id}", "editProfessor")->where(["professor_id" => "[0-9]+"])->name("editProfessor");
        Route::delete("destroy/{professor_id}", "destroyProfessor")->where(["professor_id" => "[0-9]+"])->name("destroyProfessor");
    });

    //--------- - --- student -----------------------
    Route::prefix("student/")->name("student.")->group(function () {
        Route::get("index", "indexStudent")->name("indexStudent");
        Route::post("store", "storeStudent")->name("storeStudent");
        Route::put("edit/{id}", "editStudent")->where(["id" => "[0-9]+"])->name("editStudent");
        Route::delete("destroy/{id}", "destroyStudent")->where(["id" => "[0-9]+"])->name("destroyStudent");
    });

    //--------- - --- departement -----------------------
    Route::prefix("department/")->name("department.")->group(function () {
        Route::get("index", "indexDepartment")->name("indexDepartment");
        Route::post("store", "storeDepartment")->name("storeDepartment");
        Route::put("edit/{id}", "editDepartment")->where(["id" => "[0-9]+"])->name("editDepartment");
        Route::delete("destroy/{id}", "destroyDepartment")->where(["id" => "[0-9]+"])->name("destroyDepartment");
    });

    //--------- - --- sector -----------------------
    Route::prefix("sector/")->name("sector.")->group(function () {
        Route::get("index", "indexSector")->name("indexSector");
        Route::post("store", "storeSector")->name("storeSector");
        Route::put("edit/{id}", "editSector")->where(["id" => "[0-9]+"])->name("editSector");
        Route::delete("destroy/{id}", "destroySector")->where(["id" => "[0-9]+"])->name("destroySector");
    });
});




/********************** Professor management *************************/

Route::prefix("auth/professor/")->controller(ProfessorController::class)->middleware("auth.token")->name("professor.")->group(function () {

    //--------- - --- Dashbord student statistics  -----------------------
    Route::get("indexStudentsStatistics/{professor_id}","indexStudStatis")->where(["professor_id" => "[0-9]+"])->name("indexStudStatis");

    //--------- - --- courses -----------------------
    Route::prefix("courses/")->name("courses.")->group(function () {
        Route::get("index/{professor_id}", "indexCourse")->where(["professor_id" => "[0-9]+"])->name("indexCourse");
        Route::post("store/{professor_id}", "storeCourse")->where(["professor_id" => "[0-9]+"])->name("storeCourse");
        Route::put("edit/{professor_id}/{course_id}", "editCourse")->where(["professor_id" => "[0-9]+", "course_id" => "[0-9]+"])->where(["id" => "[0-9]+"])->name("editCourse");
        Route::delete("destroy/{professor_id}/{course_id}", "destroyCourse")->where(["professor_id" => "[0-9]+", "course_id" => "[0-9]+"])->name("destroyCourse");
    });

    //--------- - --- students -----------------------
    Route::prefix("students/")->name("students.")->group(function () {
        Route::get("index/{professor_id}", "indexStudent")->where(["professor_id" => "[0-9]+"])->name("indexStudent");
    });


    //--------- - --- Announcements -----------------------
    Route::prefix("announcements/")->name("announcements.")->group(function () {
        Route::get("index/{professor_id}", "indexAnnouncement")->where(["professor_id" => "[0-9]+"])->name("indexAnnouncement");
        Route::post("store/{professor_id}", "storeAnnouncement")->where(["professor_id" => "[0-9]+"])->name("storeAnnouncement");
        Route::put("edit/{professor_id}/{announcement_id}", "editAnnouncement")->where(["professor_id" => "[0-9]+", "announcement_id" => "[0-9]+"])->name("editAnnouncement");
        Route::delete("destroy/{professor_id}/{announcement_id}", "destroyAnnouncement")->where(["professor_id" => "[0-9]+", "announcement_id" => "[0-9]+"])->name("destroyAnnouncement");
    });

    //--------- - --- Tasks -----------------------
    Route::prefix("tasks/")->name("tasks.")->group(function () {
        Route::get("index/{professor_id}", "indexTask")->where(["professor_id" => "[0-9]+"])->name("indexTask");
        Route::post("store/{professor_id}", "storeTask")->where(["professor_id" => "[0-9]+"])->name("storeTask");
        Route::put("edit/{professor_id}/{task_id}", "editTask")->where(["professor_id" => "[0-9]+", "task_id" => "[0-9]+"])->name("editTask");
        Route::delete("destroy/{professor_id}/{task_id}", "destroyTask")->where(["professor_id" => "[0-9]+", "task_id" => "[0-9]+"])->name("destroyTask");
        Route::get("show/{task_id}", "showTaskSubmissions")->where(["task_id" => "[0-9]+"])->name("showTaskSubmissions");
    });


    //--------- - --- Quizzes -----------------------
    Route::prefix("quizzes/")->name("quizzes.")->group(function () {
        Route::get("index/{professor_id}", "indexQuizze")->where(["professor_id" => "[0-9]+"])->name("indexQuizze");
        Route::post("store/{professor_id}", "storeQuizze")->where(["professor_id" => "[0-9]+"])->name("storeQuizze");
        Route::put("edit/{professor_id}/{quiz_id}", "editQuizze")->where(["professor_id" => "[0-9]+", "quiz_id" => "[0-9]+"])->name("editQuizze");
        Route::delete("destroy/{professor_id}/{quiz_id}", "destroyQuizze")->where(["professor_id" => "[0-9]+", "quiz_id" => "[0-9]+"])->name("destroyQuizze");
        Route::get("show/{quiz_id}","showQuizStudents")->where(["id" => "[0-9]+"])->name("showQuizStudents");
    });
});



/********************** Student management *************************/

Route::prefix("auth/student")->controller(StudentController::class)->middleware("auth.token")->name("student.")->group(function () {

    //--------------- professors -----------------------
    Route::prefix("professors/")->name("professor.")->group(function () {
        Route::get("index/{student_id}", "indexProfessor")->where(["student_id" => "[0-9]+"])->name("indexProfessor");
    });

    //--------------- coursess -----------------------
    Route::prefix("courses/")->name("course.")->group(function () {
        Route::get("index/{student_id}", "indexCourse")->where(["student_id" => "[0-9]+"])->name("indexCourse");
    });

    //--------------- quizzes -----------------------
    Route::prefix("quizzes/")->name("quize")->group(function () {
        Route::get("index/{student_id}", "indexQuiz")->where(["student_id" => "[0-9]+"])->name("indexQuiz");
        Route::post("store/{student_id}/{quiz_id}", "storeQuizNote")->where(["student_id" => "[0-9]+", "quiz_id" => "[0-9]+"])->name("storeQuizNote");
    });

    //--------------- Submissions -----------------------
    Route::prefix("submissions/")->name("submission")->group(function () {
        Route::get("indexTasks/{student_id}", "indexStudentTasks")->where(["student_id" => "[0-9]+"])->name("indexStudentTasks");
        Route::get("index/{student_id}/{task_id}", "indexSubmission")->where(["student_id" => "[0-9]+", "task_id" => "[0-9]+"])->name("indexSubmission");
        Route::post("store/{student_id}/{task_id}", "storeSubmission")->where(["student_id" => "[0-9]+", "task_id" => "[0-9]+"])->name("storeSubmission");
        Route::put("edit/{student_id}/{task_id}/{submission_id}", "editSubmission")->where(["student_id" => "[0-9]+", "task_id" => "[0-9]+", "submission_id" => "[0-9]+"])->name("editSubmission");
        Route::delete("destroy/{student_id}/{task_id}/{submission_id}", "destroySubmission")->where(["student_id" => "[0-9]+", "task_id" => "[0-9]+", "submission_id" => "[0-9]+"])->name("destroySubmission");
    });


    //--------------- Grades -----------------------
    Route::get("grades/index/{student_id}", "indexGrade")->where(["student_id" => "[0-9]+"])->name("indexGrade");


    //--------------- Announcement -----------------------
    Route::get("announcements/index/{student_id}","indexAnnouncement")->where(["student_id" => "[0-9]+"])->name("indexAnnouncement");

});



Route::get("/indexProfessors", [DirectorController::class,"indexProfessor"])->name("indexProfessor");
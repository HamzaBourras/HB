<?php

namespace App\Http\Controllers;

use App\Models\Qcm;
use App\Models\Note;
use App\Models\Task;
use App\Models\User;
use App\Models\Choice;
use App\Models\Sector;
use App\Models\Document;
use App\Models\Question;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\QcmRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\CourseRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AnnouncementRequest;

class ProfessorController extends Controller
{

    /********************************** Course *************************************/

    /**** return All courses ****/
    public function indexCourse(int $professor_id)
    {

        $cous = Document::with("sector", "user")->where(["user_id" => $professor_id])->orderBy('id', 'desc')->get();

        $courses = [];

        foreach ($cous as $cou) {
            $formatCourse = [
                "id" => $cou->id,
                "courseName" => $cou->title,
                "description" => $cou->description,
                "sector" => $cou->sector->name,
                "file" => $cou->file ? Storage::url($cou->file) : null,
                "username" => $cou->user->username
            ];

            array_push($courses, $formatCourse);
        }

        return response()->json([
            "data" => $courses
        ]);
    }


    /**** store a course ****/
    public function storeCourse(CourseRequest $request, int $professor_id)
    {

        $sector_id = Sector::where('name', $request->sector)->first()->id;

        $filename = null;

        if ($request->hasFile('file')) {
            $file = $request->validated(["file"]);
            $filename = $file->store("courses", "public");
        }


        Document::create([
            "title" => $request->courseName,
            "sector_id" => $sector_id,
            "user_id" => $professor_id,
            "description" => $request->description,
            "file" => $filename
        ]);

        return response()->json([
            "message" => "course added successfully"
        ]);
    }


    /**** edit a course ****/
    public function editCourse(CourseRequest $request, int $professor_id, int $course_id)
    {

        $sector_id = Sector::where('name', $request->sector)->first()->id;

        $filename = null;

        /** Tester sur le document **/
        $oldFile = Document::where('id', $course_id)->first();

        // si le professeur a choisi un noveau document
        if ($request->hasFile('file')) {
            // supprimer l'ancien document du dossier storage/course
            $oldFilename = $oldFile->file;
            Storage::delete("public/" . $oldFilename);

            $file = $request->validated(["file"]);
            $filename = $file->store("courses", "public");
        }
        // si l'ancien document est le meme qu'au noveau c'est à dire le professeur n'a pas choisir un autre document
        else {
            $filename = $oldFile->file;
        }

        Document::where(["id" => $course_id, "user_id" => $professor_id])->update([
            "title" => $request->courseName,
            "sector_id" => $sector_id,
            "description" => $request->description,
            "file" => $filename
        ]);

        return response()->json([
            "message" => "course updated successfully",
        ]);
    }


    /**** delete a course ****/
    public function destroyCourse(int $professor_id, int $course_id)
    {
        $oldFile = Document::where('id', $course_id)->first();
        Storage::delete("public/" . $oldFile->file);

        Document::where(["id" => $course_id, "user_id" => $professor_id])->delete();

        return response()->json([
            "message" => "course deleted successfully"
        ]);
    }



    /***************************************** Student ***************/

    /**** return All students of professor ****/
    public function indexStudent(int $professor_id)
    {

        // selectioné le prof avec ses filières
        $user = User::with("sectors", "sectors.departement")->where('id', $professor_id)->orderBy('id', 'desc')->first();

        $profStudents = [];

        foreach ($user->sectors as $sector) {    // $user->sectors représente les filères du prof
            foreach ($sector->users as $student) {   // $sector->users représente tous les étudiants de chaque filère
                if ($student->role->id == 3) {   // vérifer si c'est un étudiant
                    $formatProfStudent = [
                        "id" => $student->id,
                        "username" => $student->username,
                        "firstName" => $student->firstName,
                        "lastName" => $student->lastName,
                        "sector" => $sector->name,
                        "department" => $sector->departement->name,
                        "email" => $student->email
                    ];

                    array_push($profStudents, $formatProfStudent);
                }
            }
        }

        return response()->json([
            "data" => $profStudents
        ]);
    }



    /************************************* Announcement ************************************/

    /**** return All Announcements ****/
    public function indexAnnouncement(int $professor_id)
    {

        $allAnnouncements = Announcement::where('user_id', $professor_id)->with("sector")->orderBy('id', 'desc')->get();

        $announcements = [];

        foreach ($allAnnouncements as $anounc) {
            $formatAnnounce = [
                "id" => $anounc->id,
                "announcementName" => $anounc->announcement,
                "sector" => $anounc->sector->name
            ];

            array_push($announcements, $formatAnnounce);
        }

        return [
            "data" => $announcements
        ];
    }


    /**** store an Announcement ****/
    public function storeAnnouncement(AnnouncementRequest $request, int $professor_id)
    {

        $sector_id = Sector::where('name', $request->sector)->first()->id;

        Announcement::create([
            "announcement" => $request->announcementName,
            "sector_id" => $sector_id,
            "user_id" => $professor_id
        ]);

        return response()->json([
            "message" => "Announcement added successfully"
        ]);
    }

    /**** edit an Announcement ****/
    public function editAnnouncement(AnnouncementRequest $request, int $professor_id, int $announcement_id)
    {
        $sector_id = Sector::where('name', $request->sector)->first()->id;

        Announcement::where(["id" => $announcement_id, "user_id" => $professor_id])->update([
            "announcement" => $request->announcementName,
            "sector_id" => $sector_id,
        ]);

        return response()->json([
            "message" => "Announcement updated successfully"
        ]);
    }

    /**** delete an Announcement ****/
    public function destroyAnnouncement(int $professor_id, int $announcement_id)
    {
        Announcement::where(["id" => $announcement_id, "user_id" => $professor_id])->delete();

        return response()->json([
            "message" => "Announcement deleted successfully"
        ]);
    }



    /************************************* Tasks *************************************/

    /**** return all tasks ****/
    public function indexTask(int $professor_id)
    {

        $alltasks = Task::with("sector")->where('user_id', $professor_id)->orderBy('id', 'desc')->get();

        $profTasks = [];
        $dateActuel = Carbon::now();

        foreach ($alltasks as $task) {
            $dateDeadline = Carbon::createFromFormat('Y-m-d H:i:s', $task->deadline);

            $formatTask = [
                "id" => $task->id,
                "taskName" => $task->taskName,
                "description" => $task->description,
                "sector" => $task->sector->name,
                "deadline" => $task->deadline,
            ];

            array_push($profTasks, $formatTask);
        }

        return response()->json([
            "data" => $profTasks
        ]);
    }


    /**** store a task  *****/
    public function storeTask(TaskRequest $request, int $professor_id)
    {
        $sector_id = Sector::where('name', $request->sector)->first()->id;

        Task::create([
            "taskName" => $request->taskName,
            "user_id" => $professor_id,
            "sector_id" => $sector_id,
            "description" => $request->description,
            "deadline" => $request->deadline
        ]);

        return response()->json([
            "message" => "Task added successfully"
        ]);
    }


    /**** edit a task ****/
    public function editTask(TaskRequest $request, int $professor_id, int $task_id)
    {
        $sector_id = Sector::where('name', $request->sector)->first()->id;

        Task::where(["id" => $task_id, "user_id" => $professor_id])->update([
            "taskName" => $request->taskName,
            "sector_id" => $sector_id,
            "description" => $request->description,
            "deadline" => $request->deadline
        ]);

        return response()->json([
            "message" => "Task updated successfully",
        ]);
    }


    /**** delete a task ****/
    public function destroyTask(int $professor_id, int $task_id)
    {
        Task::where(["id" => $task_id, "user_id" => $professor_id])->delete();

        return response()->json([
            "message" => "Task deleted successfully",
        ]);
    }

    /**** return all submissions of the task ****/
    public function showTaskSubmissions(int $task_id)
    {
        $task = Task::with("submissions.user")->where('id', $task_id)->first();
        $taskSubms = $task->submissions->sortByDesc('id');

        $taskSubmissions = [];

        foreach ($taskSubms as $taskSubm) {
            $formatSubmission = [
                "id" => $taskSubm->id,
                "firstName" => $taskSubm->user->firstName,
                "lastName" => $taskSubm->user->lastName,
                "file" => $taskSubm->file ? Storage::url($taskSubm->file) : null,
            ];
            array_push($taskSubmissions, $formatSubmission);
        }

        return response()->json([
            "data" => $taskSubmissions
        ]);
    }



    /************************************* Quizzes *************************************/

    /**** return All Quizzes ****/
    public function indexQuizze(int $professor_id)
    {
        // get all quizzes for professor with question and choices
        $allQuizzes = Qcm::with("sector", "questions", "questions.choices")->where('user_id', $professor_id)->orderBy('id', 'desc')->get();

        $professorQuizzes = [];

        foreach ($allQuizzes as $quizze) {
            //refactor quizze
            $formatQuizze = [
                "id" => $quizze->id,
                "quizName" => $quizze->title,
                "noteTotale" => $quizze->noteTotale,
                "sector" => $quizze->sector->name,
                "questions" => []
            ];
            foreach ($quizze->questions as $question) {
                //refactor each question
                $formatQuestion = [
                    "id" => $question->id,
                    "question" => $question->text,
                    "note" => $question->note,
                    "answers" => []
                ];

                foreach ($question->choices as $choice) {
                    //refactor each answer for the question
                    $formatAnswer = [
                        "id" => $choice->id,
                        "answer" => $choice->text,
                        "isCorrect" =>  $choice->tr_fl
                    ];
                    array_push($formatQuestion['answers'], $formatAnswer);  // add the answer in the table of answers of question
                }
                array_push($formatQuizze['questions'], $formatQuestion);  // add the question in the table of questions 
            }
            array_push($professorQuizzes, $formatQuizze);  // add quizze in the table of professor quizzes
        }

        return response()->json([
            "data" => $professorQuizzes
        ]);
    }


    /**** store a Quizze ****/
    public function storeQuizze(QcmRequest $request, int $professor_id)
    {
        $sector_id = Sector::where('name', $request->sector)->first()->id;
        $quizNoteTotale = 0;

        foreach ($request->questions as $question) {
            $quizNoteTotale += $question['note']; // Ajouter la note de la question à la note totale du Qcm
        }

        $qcmCree = Qcm::create([
            "title" => $request->quizName,
            "user_id" => $professor_id,
            "sector_id" => $sector_id,
            "noteTotale" => $quizNoteTotale
        ]);

        foreach ($request->questions as $question) {
            $questionCree = Question::create([
                "text" => $question['question'],
                "note" => intval($question['note']),
                "qcm_id" => $qcmCree->id
            ]);

            foreach ($question['answers'] as $answer) {
                Choice::create([
                    "text" => $answer['answer'],
                    "tr_fl" => (int) $answer['isCorrect'],
                    "question_id" => $questionCree->id
                ]);
            }
        }



        return response()->json([
            "message" => "Quizze added successfully"
        ]);
    }


    /**** edit a Quizze ****/
    public function editQuizze(QcmRequest $request, int $professor_id, int $quiz_id)
    {

        $sector_id = Sector::where('name', $request->sector)->first()->id;
        $quizNoteTotale = 0;

        foreach ($request->questions as $question) {
            $quizNoteTotale += $question['note']; // Ajouter la note de la question à la note totale du Qcm
        }

        Qcm::where(["user_id" => $professor_id, "id" => $quiz_id])->update([
            "title" => $request->quizName,
            "sector_id" => $sector_id,
            "noteTotale" => $quizNoteTotale
        ]);


        foreach ($request->questions as $question) {
            Question::where(["qcm_id" => $quiz_id, "id" => $question['id']])->update([
                "text" => $question['question'],
                "note" => $question['note']
            ]);

            // $questionModifie = Question::where(["qcm_id" => $id, "id" => $question->id])->first();

            foreach ($question['answers'] as $answer) {
                Choice::where(["question_id" => $question['id'], "id" => $answer['id']])->update([
                    "text" => $answer['answer'],
                    "tr_fl" => (int) $answer['isCorrect'],
                ]);
            }
        }

        return response()->json([
            "message" => "Quizze updated successfully",
        ]);
    }

    /**** delete a Quizze ****/
    public function destroyQuizze(int $professor_id, int $quiz_id)
    {
        Qcm::where(["user_id" => $professor_id, "id" => $quiz_id])->delete();

        return response()->json([
            "message" => "Quizze deleted successfully"
        ]);
    }

    /**** return all students who passed the quiz with their note ****/
    public function showQuizStudents(int $quiz_id)
    {
        $quizNotes = Note::with("user")->where("qcm_id", $quiz_id)->get();

        $quizStudents = [];

        foreach ($quizNotes as $note) {
            $formatQuizStudent = [
                "firstName" => $note->user->firstName,
                "lastName" => $note->user->lastName,
                "studentNote" => $note->note
            ];

            array_push($quizStudents, $formatQuizStudent);
        }

        return response()->json([
            "data" => $quizStudents
        ]);
    }


    /******************************************** */

    /***** Dashbord students statistics ********/

    public function indexStudStatis(int $professor_id)
    {
        $allProfessorStudents = User::with("sectors.users.submissions", "sectors.users.notes")->where('id', $professor_id)->orderBy('id', 'desc')->first();

        $studentsStatics = [];

        foreach ($allProfessorStudents->sectors as $sector) {
            foreach ($sector->users as $student) {
                    $format = [
                        "assignments" => $student->submissions->count(),
                        "quizzes" => $student->notes->count()
                    ];
                    $studentsStatics[$student->firstName . " " . $student->lastName] = $format;
                
            }
        }

        // fonction pour trier les statistiques des étudiants
        $compareStudents = function ($a, $b) {
            $totalA = $a['assignments'] + $a['quizzes'];
            $totalB = $b['assignments'] + $b['quizzes'];
            return $totalB <=> $totalA;
        };

        // trier les étudiants
        uasort($studentsStatics, $compareStudents);

        // prend les 5 les plus actifs
        $actifStudents = array_slice($studentsStatics, 0, 5, true);

        $actifStudents = (object) $actifStudents;

        return response()->json([
            "data" => $actifStudents
        ]);
    }
}

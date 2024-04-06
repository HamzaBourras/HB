<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Qcm;
use App\Models\User;
use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Requests\QcmRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SubmissionRequest;
use App\Models\Note;

class StudentController extends Controller
{

    /************ return all professors of the student ******************/
    public function indexProfessor(int $student_id)
    {
        $studentProf = User::with("sector.user")->where('id', $student_id)->first();  //all professor for student

        $allProfessors = $studentProf->sector->user->sortByDesc('id');

        $studProfessors = [];

        foreach ($allProfessors as $prof) {
            $formatProfessor = [
                "id" => $prof->id,
                "username" => $prof->username,
                "firstname" => $prof->firstName,
                "lastname" => $prof->lastName,
                "email" => $prof->email
            ];

            array_push($studProfessors, $formatProfessor);
        }

        return response()->json([
            "data" => $studProfessors
        ]);
    }


    /************ return all courses of the student ******************/
    public function indexCourse(int $student_id)
    {
        $studentCour = User::with("sector.documents")->where('id', $student_id)->first();

        $latestCourses = $studentCour->sector->documents->sortByDesc('id');

        $studCourses = [];

        foreach ($latestCourses as $cour) {
            $formatCourse = [
                "id" => $cour->id,
                "courseName" => $cour->title,
                "file" => $cour->file ? Storage::url($cour->file) : null,
            ];

            array_push($studCourses, $formatCourse);
        }

        return response()->json([
            "data" => $studCourses
        ]);
    }



    /*************** Quizzes ***************/

    /**** return all quizzes of the student ****/
    public function indexQuiz(int $student_id)
    {
        $allStudentQuiz = User::with("sector.qcms.questions.choices",)->where('id', $student_id)->first();  // all quizzes of the student
        $submittedQuizzesIds = Note::where("user_id", $student_id)->pluck("qcm_id")->toArray();

        $studentQuizzes = [];

        foreach ($allStudentQuiz->sector->qcms as $quizze) {
            //refactor quizze
            $formatQuizze = [
                "id" => $quizze->id,
                "quizName" => $quizze->title,
                "noteTotale" => $quizze->noteTotale,
                "isDone" => in_array($quizze->id, $submittedQuizzesIds) ? "true" : "false",
                "sector" => $allStudentQuiz->sector->name,
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
                        "isCorrect" => false
                    ];
                    array_push($formatQuestion['answers'], $formatAnswer);  // add the answer in the table of answers of question
                }
                array_push($formatQuizze['questions'], $formatQuestion);  // add the question in the table of questions 
            }
            array_push($studentQuizzes, $formatQuizze);  // add quizze in the table of professor quizzes


        }

        return response()->json([
            "data" => $studentQuizzes
        ]);
    }


    /**** calcul note for a qcm ****/
    public function storeQuizNote(QcmRequest $request, int $student_id, int $quiz_id)
    {
        $studentQuiz = $request->all();
        $dataBaseQuiz = Qcm::with("questions.choices")->where("id", $quiz_id)->first();

        $studentNote = 0;

        // parcourir les questions du quiz
        foreach ($dataBaseQuiz->questions as $dbQuestion) {
            // trouver la question correspondante dans les choix de l'étudiant
            $studentQuestion = collect($studentQuiz['questions'])->firstWhere('id', $dbQuestion->id);

            if ($studentQuestion) {
                $nbrChoiceCorrespendant = 0;
                // vérifier les choix de l'étudiant
                foreach ($dbQuestion->choices as $choice) {
                    $studentChoice = collect($studentQuestion['answers'])->firstWhere('id', $choice->id);
                    // calculer le nombre des choix correspondant
                    if ($studentChoice['isCorrect'] == $choice->tr_fl) {
                        $nbrChoiceCorrespendant++;
                    }
                }
                // vérifier si tous les choix sont correspendent
                if ($nbrChoiceCorrespendant == count($dbQuestion->choices)) {
                    $studentNote += $dbQuestion->note;
                }
            }
        }

        // inserer la note dans la base de données
        Note::create([
            "user_id" => $student_id,
            "qcm_id" => $quiz_id,
            "note" => $studentNote
        ]);

        return response()->json([
            "message" => "quiz submitted successfully",
        ]);
    }



    /************ Submissions ******************/

    /**** return all tasks for the student ****/
    public function indexStudentTasks(int $student_id)
    {
        $currentD = Carbon::now();
        $currentDate = date('Y-m-d H:i:s', strtotime($currentD));


        $studentTa = User::with(['sector.tasks' => function ($query) use ($currentDate) {
            $query->where('deadline', '>=', $currentDate);
        }])->where('id', $student_id)->first();

        $submittedTasksIds = Submission::where("user_id", $student_id)->pluck("task_id")->toArray();

        $studentTasks = [];

        foreach ($studentTa->sector->tasks as $task) {
            $formatTask = [
                "id" => $task->id,
                "taskName" => $task->taskName,
                "description" => $task->description,
                "deadline" => $task->deadline,
                "submitted" => in_array($task->id, $submittedTasksIds) ? true : false
            ];

            array_push($studentTasks, $formatTask);
        }

        return response()->json([
            "data" => $studentTasks,
        ]);
    }


    /**** return the submissions for a task ****/
    public function indexSubmission(int $student_id, int $task_id)
    {
        $taskSub = Submission::where(["user_id" => $student_id, "task_id" => $task_id])->first();

        $taskSubmission = [
            "id" => $taskSub->id,
            "file" => $taskSub->file ? Storage::url($taskSub->file) : null
        ];

        return response()->json([
            "data" => $taskSubmission
        ]);
    }


    /**** store a submission for a task ****/
    public function storeSubmission(SubmissionRequest $request, int $student_id, int $task_id)
    {
        $filename = null;

        if ($request->hasFile('file')) {
            $file = $request->validated(["file"]);
            $filename = $file->store("submissions", "public");
        }

        Submission::create([
            "task_id" => $task_id,
            "user_id" => $student_id,
            "file" => $filename
        ]);

        return response()->json([
            "message" => "submission added successfully"
        ]);
    }


    /**** edit a submission for a task ****/
    public function editSubmission(SubmissionRequest $request, int $student_id, int $task_id, int $submission_id)
    {

        // supprimer l'ancien document du dossier storage/course
        $oldFile = Submission::where('id', $task_id)->first();
        $oldFilename = $oldFile->file;
        Storage::delete("public/" . $oldFilename);

        // enregistrer le nouveau document 
        $file = $request->validated(["file"]);
        $filename = $file->store("courses", "public");

        Submission::where(["user_id" => $student_id, "task_id" => $task_id, "id" => $submission_id])->update([
            "file" => $filename
        ]);

        return response()->json([
            "message" => "submission updated successfully"
        ]);
    }


    /**** destroy a submission for a task ****/
    public function destroySubmission(int $student_id, int $task_id, int $submission_id)
    {
        $oldFile = Submission::where('id', $submission_id)->first();
        Storage::delete("public/" . $oldFile->file);

        Submission::where(["user_id" => $student_id, "task_id" => $task_id, "id" => $submission_id])->delete();

        return response()->json([
            "message" => "submission deleted successfully"
        ]);
    }



    /*********** return all grades of the students ***********/
    public function indexGrade(int $student_id)
    {
        $allGrades = Note::with("qcm")->where("user_id", $student_id)->get();

        $studentGrades = [];

        foreach ($allGrades as $grade) {
            $formatGrade = [
                "quizName" => strtoupper($grade->qcm->title),
                "grade" => $grade->note,
                "noteTotale" => $grade->qcm->noteTotale
            ];
            array_push($studentGrades, $formatGrade);
        }


        return response()->json([
            "data" => $studentGrades
        ]);
    }


    /********************* return all announcements of the student *************************/
    public function indexAnnouncement(int $student_id)
    {
        $student = User::with("sector.announcements.user")->where("id", $student_id)->first();
        $studentAnnounc = $student->sector->announcements()->orderBy('id', 'desc')->get();

        $studentAnnouncements = [];

        foreach ($studentAnnounc as $announcement) {
            $format = [
                "id" => $announcement->id,
                "announcement" => $announcement->announcement,
                "professorName" => $announcement->user->firstName . " " . $announcement->user->lastName
            ];
            array_push($studentAnnouncements, $format);
        }

        return response()->json([
            "data" => $studentAnnouncements
        ]);
    }
}

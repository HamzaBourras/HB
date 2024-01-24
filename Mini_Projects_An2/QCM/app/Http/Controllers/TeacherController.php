<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\QuestionRequest;
use App\Http\Requests\SelectQuestions;
use App\Http\Requests\SelectQuestionsRequest;
use App\Models\CHOIX;
use App\Models\QCM;

class TeacherController extends Controller
{
    //
    public function index()
    {
        $user_id = Auth::user()->id;
        $questions = Question::with("user")->where('user_id', $user_id)->get();

        return view('teacher.index', ["titre" => "Teacher Home", "questions" => $questions]);
    }


    public function createQuestion()
    {
        return view('teacher.createQuestion', ["titre" => "Add question"]);
    }


    public function storeQuestion(QuestionRequest $request)
    {
        Question::create([
            "text" => $request->textQuestion,
            "user_id" => Auth::user()->id
        ]);

        return redirect()->route('teacher.createQuestion');
    }


    public function createSelectQuestions()
    {
        $user_id = Auth::user()->id;
        $allQuestions = Question::with("user")->where('user_id', $user_id)->get();
        return view('teacher.createSelectQuestions', ["titre" => "Select Questions", "allQuestions" => $allQuestions]);
    }


    public function storeSelectQuestions(SelectQuestionsRequest $request)
    {
        $allQuestionsSelectedIds = $request->get('SelectQuestions');

        $allQuestionsSelected = Question::whereIn('id', $allQuestionsSelectedIds)->get();

        return view('teacher.createQcm', ["titre" => "Create QCM", "allQuestionsSelected" => $allQuestionsSelected]);
    }


    public function storeQcm(Request $request)
    {
        $allQuestionsId = [];

        $allChoices = $request->get("choices");
        foreach ($allChoices as $choice) {

            $choicesArray = explode('**', $choice);  // diviser le choix selon le caractere "**"
            $choiceText = $choicesArray[0];
            $trueOrFalse = $choicesArray[1];
            $questionId = $choicesArray[2];

            array_push($allQuestionsId, $questionId);  // ce tableau je veux l'utiliser pour update la colon qcm_id

            // stocker les choix dans la table choixes

            if($trueOrFalse == "true") $trueOrFalse = 1;
            elseif($trueOrFalse == "false") $trueOrFalse = 0;

            CHOIX::create([
                "text" => $choiceText,
                "tr_fl" => $trueOrFalse,
                "question_id" => $questionId
            ]);

            
        }
        
        // stocker le qcm
        $qcmTitle = $request->get('QcmTitle');
        $user_id = Auth::user()->id;
        QCM::create([
            "title" => $qcmTitle,
            "user_id" => $user_id
        ]);

        // update le colon qcm_id dans la table questions 
        $qcmCreeId = QCM::orderBy('id', 'desc')->first()->id;
        Question::whereIn('id', $allQuestionsId)
            ->update(['q_c_m_id' => $qcmCreeId]);

        return redirect()->route('teacher.index');
    }


}

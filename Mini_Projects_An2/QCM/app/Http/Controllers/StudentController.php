<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentAnswerRequest;
use App\Models\CHOIX;
use App\Models\QCM;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator as ValidationValidator;

class StudentController extends Controller
{
    //
    public function index () {
            $allQcms = QCM::all();
        
            return view('student.index',["titre"=> "Home","allQcms"=>$allQcms]);
        
    }


    public function passQcm (int $id) {
        $qcm = QCM::with("questions.choixes")->where("id",$id)->first();
        

        return view('student.passQcm',["titre"=>"Pass Qcm","qcm"=>$qcm]);
    }


    public function storeCheckResult (StudentAnswerRequest $request) {
        
        $allChoicesCorrect = CHOIX::where('tr_fl',1)->get();
        $studentAnswers = $request->get('studentAnswers');

        $allChoicesCorrectString = [];

        foreach($allChoicesCorrect->toArray() as $choicesCorrect){
                // remplir le tableau allChoicesCorrectString par le "text" des choixes dans la base de données
            array_push($allChoicesCorrectString,trim($choicesCorrect["text"])); 

        }

        $studentScore = count(array_intersect($allChoicesCorrectString, $studentAnswers));
       
        return view('student.studentResult',["titre"=>"Student Result","studentScore"=>$studentScore]);
    }
}

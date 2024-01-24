<?php

namespace App\Http\Controllers;

use App\Models\QCM;
use Illuminate\Http\Request;

class QCMController extends Controller
{
    public function showAllQcms () {
        $allQcms = QCM::all();
    
        return view('qcm.showAllQcms',["titre"=> "Show All Qcms","allQcms"=>$allQcms]);
    }


    public function showQcm (int $id) {
        $qcm = QCM::with("questions.choixes")->where("id",$id)->first();
        

        return view('qcm.showQcm',["titre"=>"Show Qcm","qcm"=>$qcm]);
    }
}

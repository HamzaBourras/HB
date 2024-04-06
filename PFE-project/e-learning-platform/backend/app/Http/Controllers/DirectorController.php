<?php

namespace App\Http\Controllers;

use stdClass;
use App\Models\User;
use App\Models\Sector;
use Nette\Utils\ArrayHash;
use App\Models\Departement;
use App\Models\SectorsUsers;
use Illuminate\Http\Request;
use App\Http\Requests\SectorRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\infosProfileMail;
use App\Http\Requests\StudentRequest;
use App\Http\Requests\ProfessorRequest;
use App\Http\Requests\DepartementRequest;

class DirectorController extends Controller
{
    // fonction pour generer une chaine de caractère
    public function generateRandomString($length = 5) {
        $bytes = random_bytes($length);
        return bin2hex($bytes);
    }


    /*********** Professor ***************/

    /**** return All professors ****/

    public function indexProfessor()
    {
        $profs =  User::with("sectors", "departement")->where('role_id', 2)->orderBy('id', 'desc')->get();

        $professors = [];
        // dd($profs[0]->departement->name);

        foreach ($profs as $prof) {

            // stocker tous les filières du professeurs dans un array
            $profSectors = [];
            foreach ($prof->sectors as $sect) {
                array_push($profSectors, $sect->name);
            }

            // représenter le prof sous la format
            $formatProfessor = [
                "id" => $prof->id,
                "firstName" => $prof->firstName,
                "lastName" => $prof->lastName,
                "username" => $prof->username,
                "email" => $prof->email,
                "password" => $prof->password,
                "department" => $prof->departement->name,
                "sectors" => $profSectors
            ];

            // stocker tous les professeurs dans un array
            array_push($professors, $formatProfessor);
        }

        return response()->json([
            "data" => $professors
        ]);
    }


    /**** store a professor ****/

    public function storeProfessor(ProfessorRequest $request)
    {
        
        $randomString = $this->generateRandomString();
        $password = $request->email.$randomString;

        // selectioné l'id du departement
        $departement_id = Departement::where('name', $request->department)->first()->id;

        $professorCree = User::create([
            "firstName" => $request->firstName,
            "lastName" => $request->lastName,
            "username" => $request->username,
            "email" => $request->email,
            "role_id" => 2,
            "departement_id" => $departement_id,
            "password" => $password
        ]);

        // enregistré les ids des sectors selectioné
        $sectors_id = [];

        array_push($sectors_id, Sector::whereIn('name', $request->sectors)->pluck('id')->toArray());
        $sectors_id = $sectors_id[0];  // ici parsque $sectors_id c'est un tableau à l'interieur d'un tableau

        // inserer les ids des sectors et du professor dans la table de relation many to many
        foreach ($sectors_id as $sector_id) {
            SectorsUsers::create([
                "users_id" => $professorCree->id,
                "sectors_id" => $sector_id
            ]);
        }

        // envoyer un email à le professeur contient les informations d'authentification
        Mail::to($request->email)->send(new infosProfileMail($request->username, $password, $request->firstName." ".$request->lastName));

        return response()->json([
            "message" => "Professor added successfully"
        ]);
    }

    /**** edit a professor ****/

    public function editProfessor(ProfessorRequest $request, int $professor_id)
    {
        // selectioné l'id du departement
        $departement_id = Departement::where('name', $request->department)->first()->id;

        User::where(['id' => $professor_id, "role_id" => 2])->update([
            "firstName" => $request->firstName,
            "lastName" => $request->lastName,
            "username" => $request->username,
            "email" => $request->email,
            "departement_id" => $departement_id
        ]);

        // enregistré les ids des sectors selectioné
        $sectors_id = [];

        array_push($sectors_id, Sector::whereIn('name', $request->sectors)->pluck('id')->toArray());
        $sectors_id = $sectors_id[0];  // ici parsque $sectors_id c'est un tableau à l'interieur d'un tableau


        // supprimer les anciens sectors du prof
        SectorsUsers::where('users_id', $professor_id)->delete();

        // inserer les ids des sectors et du professor dans la table de relation many to many
        foreach ($sectors_id as $sector_id) {
            SectorsUsers::create([
                "users_id" => $professor_id,
                "sectors_id" => $sector_id
            ]);
        }

        return response()->json([
            "message" => "Professor updated successfully",
        ]);
    }


    /**** delete a professor ****/

    public function destroyProfessor(int $id)
    {
        User::where(['id' => $id, "role_id" => 2])->delete();

        return response()->json([
            "message" => "Professor deleted successfully"
        ]);
    }



    /**************************************************************************** */

    /*********** Student ***************/

    /**** return All students ****/

    public function indexStudent()
    {
        $studs = User::with("sector", "sector.departement")->where('role_id', 3)->orderBy('id', 'desc')->get();

        $students = [];

        foreach ($studs as $stud) {
            $formatStudent = [
                "id" => $stud->id,
                "firstName" => $stud->firstName,
                "lastName" => $stud->lastName,
                "username" => $stud->username,
                "email" => $stud->email,
                "password" => $stud->password,
                "department" => $stud->sector->departement->name,
                "sector" => $stud->sector->name
            ];

            array_push($students, $formatStudent);
        }
        return response()->json([
            "data" => $students
        ]);
    }

    /**** store a student ****/

    public function storeStudent(StudentRequest $request)
    {
        
        $randomString = $this->generateRandomString();
        $password = $request->email.$randomString;

        $sector_id = Sector::where('name', $request->sector)->first()->id;
        User::create([
            "firstName" => $request->firstName,
            "lastName" => $request->lastName,
            "username" => $request->username,
            "email" => $request->email,
            "role_id" => 3,
            "sector_id" => $sector_id,
            "password" => $password
        ]);

        // envoyer un email à l'étudiant contient les informations d'authentification
        Mail::to($request->email)->send(new infosProfileMail($request->username, $password, $request->firstName." ".$request->lastName));

        return response()->json([
            "message" => "Student added successfully"
        ]);
    }

    /**** edit a student ****/

    public function editStudent(StudentRequest $request, int $id)
    {
        $sector_id = Sector::where('name', $request->sector)->first()->id;

        User::where(['id' => $id, "role_id" => 3])->update([
            "firstName" => $request->firstName,
            "lastName" => $request->lastName,
            "username" => $request->username,
            "email" => $request->email,
            "sector_id" => $sector_id
        ]);

        return response()->json([
            "message" => "Student updated successfully"
        ]);
    }

    /**** delete a student ****/

    public function destroyStudent(int $id)
    {
        User::where(["id" => $id, "role_id" => 3])->delete();

        return response()->json([
            "message" => "Student deleted successfully"
        ]);
    }



    /**************************************************************************** */

    /*********** Departement ***************/

    /**** return All departements ****/

    public function indexDepartment()
    {
        $departements = Departement::orderBy('id', 'desc')->get(['id', 'name as department']);

        return response()->json([
            "data" => $departements
        ]);
    }

    /**** store a departement ****/

    public function storeDepartment(DepartementRequest $request)
    {
        Departement::create([
            "name" => $request->department
        ]);

        return response()->json([
            "message" => "Department added successfully"
        ]);
    }

    /**** edit a departement ****/

    public function editDepartment(DepartementRequest $request, int $id)
    {
        Departement::where('id', $id)->update([
            "name" => $request->department
        ]);

        return response()->json([
            "message" => "Department updated successfully"
        ]);
    }

    /**** delete a departement ****/

    public function destroyDepartment(int $id)
    {
        Departement::where('id', $id)->delete();

        return response()->json([
            "message" => "Department deleted successfully"
        ]);
    }



    /**************************************************************************** */

    /*********** Sector ***************/

    /**** return All sectors ****/

    public function indexSector()
    {
        $sects = Sector::with("departement")->orderBy('id', 'desc')->get();

        $sectors = [];

        foreach ($sects as $sect) {
            $formatSect = [
                "id" => $sect->id,
                "department" => $sect->departement->name,
                "sector" => $sect->name
            ];

            array_push($sectors, $formatSect);
        }

        return response()->json([
            "data" => $sectors
        ]);
    }

    /**** store a sector ****/

    public function storeSector(SectorRequest $request)
    {
        $departement_id = Departement::where('name', $request->department)->first()->id;

        Sector::create([
            "name" => $request->sector,
            "departement_id" => $departement_id
        ]);

        return response()->json([
            "message" => "Sector added successfully"
        ]);
    }

    /**** edit a sector ****/

    public function editSector(SectorRequest $request, int $id)
    {
        $departement_id = Departement::where('name', $request->department)->first()->id;

        Sector::where('id', $id)->update([
            "name" => $request->sector,
            "departement_id" => $departement_id
        ]);

        return response()->json([
            "message" => "Sector updated successfully"
        ]);
    }

    /**** delete a sector ****/

    public function destroySector(int $id)
    {
        Sector::where('id', $id)->delete();

        return response()->json([
            "message" => "Sector deleted successfully"
        ]);
    }


    /******************************************** */

    /***** Dashbord professors statistics ********/

    public function indexProfStatis()
    {
        $allProfessors = User::with("qcms", "tasks", "documents")->where("role_id",2)->get();

        $professorsStatics = [];

        foreach($allProfessors as $prof) {
            $format = [
                "assignments" => $prof->tasks->count(),
                "courses" => $prof->documents->count(),
                "quizzes" => $prof->qcms->count()
            ];
            $professorsStatics[$prof->firstName." ".$prof->lastName] = $format;
        }

        // fonction pour trier les statistiques des profs
        $compareProfessors = function ($a, $b) {
            $totalA = $a['assignments'] + $a['courses'] + $a['quizzes'];
            $totalB = $b['assignments'] + $b['courses'] + $b['quizzes'];
            return $totalB <=> $totalA;
        };

        // trier les profs
        uasort($professorsStatics, $compareProfessors);

        // prend les 5 les plus actifs
        $actifProfessors = array_slice($professorsStatics,0,5,true);

        $actifProfessors = (Object) $actifProfessors;


        return response()->json([
            "data" => $actifProfessors
        ]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function createRegister()
    {
        return view('user.createRegister', ["titre" => "Register"]);
    }

    public function storeRegister(UserRequest $request)
    {

        $roleStudentId = Role::where('name', "student")->first()->id;  // selectioner l'id du role student

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role_id' => $roleStudentId
        ]);

        return redirect()->route('user.createLogin');
    }


    public function createLogin()
    {
        return view('user.createLogin', ["titre" => "Login"]);
    }

    public function storeLogin(UserRequest $request)
    {
        $validated = $request->validated();

        if (Auth::attempt($validated)) {
            $userRole = Auth::user()->role->name;

            // dd($userRole);
            if($userRole == "student"){
                return redirect()->route('student.index');
            }elseif($userRole == "teacher"){
                return redirect()->route('teacher.index');
            }
            

        } else {
            return redirect()->route('user.createLogin')->withErrors(['erreurlogin' => 'Email or password invalid']);
        }
        
    }


    public function logout () {
        Auth::logout();
        return redirect()->route('home');
    }
}

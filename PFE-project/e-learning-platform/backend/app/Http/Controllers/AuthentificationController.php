<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthentificationRequest;
use App\Models\PersonalAccessToken;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class AuthentificationController extends Controller
{

    /******************* login *******************/
    public function login(AuthentificationRequest $request)
    {

        // vérifier si les informations sont corrects
        if (!Auth::attempt($request->only('username', 'password'))) {
            return response()->json([
                "message" => "Username or Password is invalid"
            ]);
        }

        $user = $request->user();

        $userAuth = [
            "id" => $user->id,
            "firstName" => $user->firstName,
            "lastName" => $user->lastName,
            "username" => $user->username,
            "email" => $user->email,
            "bio" => $user->bio,
            "role" => $user->role->name,
            "sectors" => []
        ];

        $sectors = [];

        // if user is a professor
        if ($user->role_id == 2) {
            $allSectors = $user->sectors()->get();
            foreach ($allSectors as $sector) {
                array_push($sectors, $sector->name);
            }
        }
        //if user is a student
        elseif ($user->role_id == 3) {
            $sector = $user->sector()->first();
            array_push($sectors, $sector->name);
        }

        $userAuth['sectors'] = $sectors;  // add sectors in userAuth

        $token = $user->createToken($user->username)->plainTextToken;  // enregistré l'utilisateur dans token

        return response()->json([
            'token' => $token,
            'data' => $userAuth
        ]);
    }


    /******************** logout *****************/
    public function logout(int $user_id)
    {
        
        PersonalAccessToken::where("tokenable_id", $user_id)->delete();

        return response()->json([
            "message" => "logged out"
        ]);
    }


    /******************** update profile ******************/
    public function updateProfile(AuthentificationRequest $request, int $user_id)
    {
        $username = substr($request->firstName, 0, 1) . '.' . $request->lastName;

        $user = User::find($user_id);
        $user->username = strtolower($username);
        $user->firstName = strtolower($request->firstName);
        $user->lastName = strtolower($request->lastName);
        $user->email = $request->email;
        
        if($request->bio) {
            $user->bio = $request->bio;
        }

        if ($request->password) {
            $user->password = $request->password; 
        }

        $user->save();

        $userAuth = [
            "id" => $user->id,
            "firstName" => $user->firstName,
            "lastName" => $user->lastName,
            "username" => $user->username,
            "email" => $user->email,
            "role" => $user->role->name,
            "bio" => $user->bio,
            "sectors" => []
        ];

        $sectors = [];

        // if user is a professor
        if ($user->role_id == 2) {
            $allSectors = $user->sectors()->get();
            foreach ($allSectors as $sector) {
                array_push($sectors, $sector->name);
            }
        }
        //if user is a student
        elseif ($user->role_id == 3) {
            $sector = $user->sector()->first();
            array_push($sectors, $sector->name);
        }

        $userAuth['sectors'] = $sectors;  // add sectors in userAuth

        return response()->json([
            "data" => $userAuth,
            "message" => "profile updated successfully"
        ]);
    }


    /********************** forgot password *******************/
    public function forgotPassword () 
    {
        return redirect("http://localhost:8000/forgot-password");
    }


    /********************** reset password ***********************/
    public function reset(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Here we will attempt to reset the user's password. If it is successful we
        // will update the password on an actual user model and persist it to the
        // database. Otherwise we will parse the error and return the response.
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        // If the password was successfully reset, we will redirect the user back to
        // the application's home authenticated view. If there is an error we can
        // redirect them back to where they came from with their error message.
        if ($status == Password::PASSWORD_RESET) {
            return redirect("http://localhost:5173?message=Your%20password%20has%20been%20reset");
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
}

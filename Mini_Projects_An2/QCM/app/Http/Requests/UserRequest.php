<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       
            // validation pour register
        if ($this->route()->uri() == "user/storeRegister") {
            return [
                'name' => "required|min:5",
                'email' => "required|email|unique:users",
                'password' => "required|min:4|max:12",
                'verifypassword' => 'required|same:password'
            ];
            // validation pour login
        } elseif ($this->route()->uri() == "user/storeLogin") {
            return [
                'email' => "required|email",
                'password' => "required|min:4|max:12",
            ];
        }
        
    }
}

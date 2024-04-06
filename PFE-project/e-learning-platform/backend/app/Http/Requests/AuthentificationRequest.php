<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthentificationRequest extends FormRequest
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
        $url = $this->url();

        if(strpos($url, 'api/login') !== false) {
            return [
                "username" => "required",
                "password" => "required"
            ];
        }
        elseif(strpos($url, 'api/auth/updateProfile') !== false) {
            return [
                "firstName" => "required",
                "lastName" => "required",
                "email" => "required|email",
                "passwordConfirmation" => "same:password"
            ];
        }

        return [];
    }
}

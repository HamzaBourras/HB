<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
        
        if(strpos($url, 'api/auth/director/professor/store') !== false) {
            return [
                "firstName"=>"required",
                "lastName"=>"required",
                "username"=>"required",
                "email"=>"required|email|",
                "sector"=>"required"
            ];
        }
        elseif(strpos($url, 'api/auth/director/professor/edit') !== false) {
            return [
                "firstName"=>"required",
                "lastName"=>"required",
                "username"=>"required",
                "email"=>"required|email|",
                "sector"=>"required"
            ];
        }

        return [];
    }
}

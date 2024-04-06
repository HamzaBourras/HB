<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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

        if (strpos($url, 'api/auth/professor/courses/store') !== false) {
            return [
                "courseName" => "required",
                "sector" => "required",
                "description" => "required",
                "file" => "required|max:300",
                
            ];
        }
        
        elseif (strpos($url, 'api/auth/professor/courses/edit') !== false) {
            return [
                "courseName" => "required",
                "sector" => "required",
                "description" => "required",
                
            ];
        }

        return [];


    }
}

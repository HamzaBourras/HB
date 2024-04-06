<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QcmRequest extends FormRequest
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
        return [
            "quizName" => "required",
            "sector" => "required",
            "questions" => "required",
            "questions.*.question" => "required",
            "questions.*.note" => "required",
            "questions.*.answers" => "required",
            "questions.*.answers.*.answer" => "required",
            "questions.*.answers.*.isCorrect" => "required",
        ];
    }
}

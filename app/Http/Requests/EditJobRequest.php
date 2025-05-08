<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditJobRequest extends FormRequest
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
            'title' => 'required|min:2',
            'category' => 'required',
            'type' => 'required',
            'salary' => 'required|numeric',
            'deadline' => 'required|date|after:tomorrow',
            // 'deadline' => 'required|date',
            'description' => 'required'
            
        ];
    }
}

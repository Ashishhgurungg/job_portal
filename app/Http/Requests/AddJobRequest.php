<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        //if company user return true
        return true; // make it false here later if you wan't to make it unauthorized 
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
            'category' => 'required|numeric',
            'type' => 'required',
            'salary' => 'required|numeric',
            'deadline' => 'required|date|after:tomorrow',
            // 'deadline' => 'required|date',
            'description' => 'required'
            
        ];
    }
}

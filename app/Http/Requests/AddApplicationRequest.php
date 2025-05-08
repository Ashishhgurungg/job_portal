<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddApplicationRequest extends FormRequest
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
        'resume' => 'required|file|mimes:pdf,doc,docx,jpeg,jpg|max:2048', // Resume file validation
        'cover'  => 'required|string|min:5|max:1000', // Cover letter validation
        'status' => 'required'
        ];
        
    }
}

<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // return [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => [
        //         'required',
        //         'string',
        //         'lowercase',
        //         'email',
        //         'max:255',
        //         Rule::unique(User::class)->ignore($this->user()->id),
        //     ],
        // ];

        $userId = $this->user()->id;

        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($userId),
            ],
            'role'    => ['required', 'string'],
            'address' => ['required', 'string', 'max:255'],
            'phone'   => ['nullable', 'string', 'max:10'],
            'about'   => ['nullable', 'string'],
            'image'   => ['nullable', 'image', 'max:2048'],
            'gender'  => ['nullable'],
        ];
    }
}

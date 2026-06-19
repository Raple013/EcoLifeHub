<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'weight_kg' => ['nullable', 'numeric', 'min:20', 'max:300'],
            'height_cm' => ['nullable', 'integer', 'min:80', 'max:250'],
            'city' => ['nullable', 'string', 'max:100'],
        ];
    }
}

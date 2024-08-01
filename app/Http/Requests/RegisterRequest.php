<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest {
    public function rules(): array {
        return [
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'password' => [
                'required',
                'confirmed',
                 Password::min(8)
                    ->letters()
                    ->numbers()
                    ->symbols()
            ]
        ];
    }
}

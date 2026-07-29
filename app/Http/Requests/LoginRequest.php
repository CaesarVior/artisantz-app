<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string',
        ];
    }

    /**
     * Custom message untuk pesan validasi login dalam Bahasa Indonesia
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format email tidak valid (contoh: user@artisantz.com).',

            'password.required' => 'Kata sandi wajib diisi.',
            'password.string' => 'Kata sandi harus berupa teks.',
        ];
    }

    /**
     * Kustomisasi nama atribut untuk fallback error message
     */
    public function attributes(): array
    {
        return [
            'email' => 'Alamat Email',
            'password' => 'Kata Sandi',
        ];
    }
}

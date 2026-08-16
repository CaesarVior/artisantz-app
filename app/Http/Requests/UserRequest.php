<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user') ?? $this->route('id');
        $isPost = $this->isMethod('post');

        return [
            'title' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,id',
            'email' => 'required|email|unique:users,email,'.($userId ?? 'NULL'),
            'phone_number' => 'nullable|numeric',
            'password' => $isPost ? 'required|string|min:8' : 'nullable|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Nama/Judul user wajib diisi.',
            'title.string' => 'Nama/Judul user harus berupa teks.',
            'title.max' => 'Nama/Judul user maksimal 255 karakter.',

            'role_id.required' => 'Role wajib dipilih.',
            'role_id.exists' => 'Role yang dipilih tidak valid.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan oleh akun lain.',

            'phone_number.numeric' => 'Nomor telepon harus berupa angka.',

            'password.required' => 'Password wajib diisi.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal harus 8 karakter.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Nama/Judul User',
            'role_id' => 'Role',
            'email' => 'Email',
            'phone_number' => 'Nomor Telepon',
            'password' => 'Password',
        ];
    }
}

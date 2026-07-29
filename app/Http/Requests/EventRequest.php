<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isPost = $this->isMethod('post');

        return [
            'name' => 'required|string|max:255',
            'theme' => 'required|string|max:255',
            'event_date' => 'required|date',
            'description' => 'required|string', // Diubah ke required agar deskripsi wajib diisi
            'photos' => $isPost ? 'required|array|min:1' : 'nullable|array',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    /**
     * Pesan validasi kustom dalam Bahasa Indonesia
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Judul event wajib diisi.',
            'name.string' => 'Judul event harus berupa teks.',
            'name.max' => 'Judul event maksimal 255 karakter.',

            'theme.required' => 'Tema acara wajib diisi.',
            'theme.string' => 'Tema acara harus berupa teks.',
            'theme.max' => 'Tema acara maksimal 255 karakter.',

            'event_date.required' => 'Tanggal event wajib ditentukan.',
            'event_date.date' => 'Format tanggal event tidak valid.',

            'description.required' => 'Deskripsi event wajib diisi.',
            'description.string' => 'Deskripsi event harus berupa teks.',

            'photos.required' => 'Minimal unggah 1 foto event.',
            'photos.array' => 'Format pengiriman foto tidak valid.',
            'photos.min' => 'Minimal unggah 1 foto event.',

            'photos.*.image' => 'File yang diunggah harus berupa gambar.',
            'photos.*.mimes' => 'Format gambar harus JPEG, PNG, JPG, atau WEBP.',
            'photos.*.max' => 'Ukuran masing-masing gambar tidak boleh lebih dari 2MB (2048 KB).',
        ];
    }

    /**
     * Custom Attribute Name (opsional, jika ada pesan bawaan Laravel yang terlewat)
     */
    public function attributes(): array
    {
        return [
            'name' => 'Judul Event',
            'theme' => 'Tema Acara',
            'event_date' => 'Tanggal Event',
            'description' => 'Deskripsi Event',
            'photos' => 'Foto Event',
        ];
    }

    /**
     * Sanitasi input XSS pada deskripsi sebelum/setelah data diproses
     */
    protected function passedValidation(): void
    {
        if ($this->filled('description')) {
            $cleanDescription = $this->description;

            // Bersihkan tag script, event inline JavaScript, dan protokol javascript:
            $cleanDescription = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $cleanDescription);
            $cleanDescription = preg_replace('/on\w+="[^"]*"/i', '', $cleanDescription);
            $cleanDescription = preg_replace('/on\w+=\'[^\']*\'/i', '', $cleanDescription);
            $cleanDescription = preg_replace('/javascript:/i', '', $cleanDescription);

            $this->merge([
                'description' => $cleanDescription,
            ]);
        }
    }
}

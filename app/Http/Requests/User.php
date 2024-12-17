<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class User extends FormRequest
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
            'name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Kolom nama harus di isi.',
            'username.required' => 'Kolom username harus di isi.',
            'password.required' => 'Kolom password harus di isi.',
            'role.required' => 'Kolom role harus di pilih.',
        ];
    }
}

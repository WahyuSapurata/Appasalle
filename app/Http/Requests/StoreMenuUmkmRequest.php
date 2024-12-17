<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuUmkmRequest extends FormRequest
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
            'menu' => 'required',
            'harga' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'menu.required' => 'Kolom menu harus di isi.',
            'harga.required' => 'Kolom harga harus di isi.',
        ];
    }
}

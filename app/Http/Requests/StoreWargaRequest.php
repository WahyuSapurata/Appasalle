<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWargaRequest extends FormRequest
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
            'nama' => 'required',
            'nprw' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan' => 'required',
            'jenis_sampah' => 'required',
            'sub_kategori' => 'required',
            'volume' => 'required',
            'tarif' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Kolom nama harus di isi.',
            'nprw.required' => 'Kolom nprw harus di isi.',
            'alamat.required' => 'Kolom alamat harus di isi.',
            'rt.required' => 'Kolom rt harus di isi.',
            'rw.required' => 'Kolom rw harus di isi.',
            'kelurahan.required' => 'Kolom kelurahan harus di isi.',
            'jenis_sampah.required' => 'Kolom kategori harus di isi.',
            'sub_kategori' => 'Kolom sub kategori harus di isi.',
            'volume' => 'Kolom volume harus di isi.',
            'tarif' => 'Kolom tarif harus di isi.',
        ];
    }
}

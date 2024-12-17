<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUmkmRequest extends FormRequest
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
            'nama_umkm' => 'required',
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kelurahan' => 'required',
            'jenis_umkm' => 'required',
            'telepon' => 'required',
            'sosial_media' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_umkm.required' => 'Kolom nama umkm harus di isi.',
            'alamat.required' => 'Kolom alamat harus di isi.',
            'rt.required' => 'Kolom rt harus di isi.',
            'rw.required' => 'Kolom rw harus di isi.',
            'kelurahan.required' => 'Kolom kelurahan harus di isi.',
            'jenis_umkm.required' => 'Kolom jenis umkm harus di isi.',
            'telepon.required' => 'Kolom no.telepon harus di isi.',
            'sosial_media.required' => 'Kolom sosial media harus di isi.',
        ];
    }
}

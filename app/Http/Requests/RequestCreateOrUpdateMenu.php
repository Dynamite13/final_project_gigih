<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCreateOrUpdateMenu extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama_menu' => 'required|max:255',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'nama_menu.required' => 'Nama menu harus diisi',
            'harga.required' => 'Harga harus diisi',
            'deskripsi.required' => 'Deskripsi harus diisi',
            'stok.required' => 'Stok harus diisi',
            'harga.numeric' => 'Harga harus berupa angka',
            'stok.numeric' => 'Stok harus berupa angka',
        ];
    }
}

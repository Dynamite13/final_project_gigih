<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStoreTransaksi extends FormRequest
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
            'nama_pelanggan' => 'required|max:255',
            'menu' => 'required',
            'jumlah' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'nama_pelanggan.required' => 'Nama pelanggan tidak boleh kosong',
            'nama_pelanggan.max' => 'Nama pelanggan maksimal 255 karakter',
            'menu.required' => 'Menu tidak boleh kosong',
            'jumlah.required' => 'Jumlah tidak boleh kosong',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
        ];
    }
}

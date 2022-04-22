<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStorePesanan extends FormRequest
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
        $rules = [
            'menu_id' => 'required|numeric',
            'jumlah' => 'required|numeric',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'menu_id.required' => 'Menu harus diisi',
            'menu_id.numeric' => 'Menu harus berupa angka',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
        ];
    }
}

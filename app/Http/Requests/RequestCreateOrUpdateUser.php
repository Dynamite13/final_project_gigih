<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestCreateOrUpdateUser extends FormRequest
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
            'username' => 'required|string|max:255',
            'role' => 'required',
        ];
        if($this->isMethod('post')) {
            $rules['username'] .= '|unique:users';
            $rules['role'] .= '|in:admin,manager,kasir';
            $rules['password'] = 'required|min:6';
            $rules['password_confirmation'] = 'required|same:password';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'username.required' => 'Username tidak boleh kosong',
            'username.string' => 'Username harus berupa string',
            'username.max' => 'Username maksimal 255 karakter',
            'username.unique' => 'Username sudah digunakan',
            'role.required' => 'Role tidak boleh kosong',
            'role.in' => 'Role harus diisi dengan admin, manager, atau kasir',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
            'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong',
            'password_confirmation.same' => 'Konfirmasi password harus sama dengan password',
        ];
    }
}

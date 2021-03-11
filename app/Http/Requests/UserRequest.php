<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'santri_id' => 'required|exists:users,santri_id',
            'email' => 'required|string|email|max:255|unique:users,id,'.request()->user()->id,
            'password' => 'required|string|confirmed|min:8',
            'role'  => 'required|in:Administrator,Pengurus,Santri'
        ];
    }
}

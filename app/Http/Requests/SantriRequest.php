<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SantriRequest extends FormRequest
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
            // 'santri_number'                 => 'required|string|unique:posts,title,'.$this->post.'|min:5',
            'santri_number'                 => 'required|string|min:5',
            'santri_name'                   => 'required|string|min:5',
            'santri_address'                => 'required|string|min:5',
            'santri_birth_place'            => 'required|string|min:5',
            'santri_birth_date'             => 'required|date',
            'santri_phone'                  => 'required|string',
            'santri_school_old'             => 'required|string',
            'santri_school_address_old'     => 'required|string',
            'santri_school_current'         => 'required|string',
            'santri_school_address_current' => 'required|string',
            'santri_father_name'            => 'required|string',
            'santri_mother_name'            => 'required|string',
            'santri_father_job'             => 'required|string',
            'santri_mother_job'             => 'required|string',
            'santri_parent_phone'           => 'required|string',
        ];
    }
}

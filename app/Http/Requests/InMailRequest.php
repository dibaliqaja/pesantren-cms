<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class InMailRequest extends FormRequest
{
    public $validator = null;

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
            'mail_number'   => 'required|string|unique:in_mails,mail_number,'.$this->surat_masuk,
            'mail_date'     => 'required|date',
            'note'          => 'required|string',
            'sender'        => 'required|string',
            'recipient'     => 'required|string',
            'record_date'   => 'required|date',
            'file_in'       => 'file|mimes:jpg,jpeg,png,doc,docx,pdf',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this->validator = $validator;
    }
}

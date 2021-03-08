<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OutMailRequest extends FormRequest
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
            'mail_number'   => 'required|string|unique:out_mails,mail_number,'.$this->out_mail,
            'mail_date'     => 'required|date',
            'note'          => 'required|string',
            'sender'        => 'required|string',
            'recipient'     => 'required|string',
            'record_date'   => 'required|date',
            'file_in'       => 'file|mimes:jpg,jpeg,png,doc,docx,pdf',
        ];
    }
}

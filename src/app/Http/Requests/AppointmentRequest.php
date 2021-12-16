<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder as RB;

class AppointmentRequest extends FormRequest
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
        switch ($this->method()){
            case 'PUT':
            case 'POST':
                return [
                    'appointment_address' => ['required'],
                    'appointment_date' =>    ['required','date_format:Y-m-d H:i:s'],
                    'contact_email' =>       ['required','email'],
                    'contact_phonenumber' => ['required'],
                    'contact_name' =>        ['required', 'string'],
                    'contact_surname' =>     ['required', 'string'],
                    'post_code' =>           ['required', 'string', Rule::postcode()]
                ];
                break;
            default:
                return [];
                break;
        }

    }


    public function failedValidation(Validator $validator)
    {

        throw new HttpResponseException(
            RB::error(400,[],$validator->errors())->setStatusCode(400)
        );
    }

}

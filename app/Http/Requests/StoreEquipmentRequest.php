<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreEquipmentRequest extends FormRequest
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
            'type_id' => 'required',
            'serial_number' => 'required|max:255',
            'comment' => 'required|max:500',
        ];
    }

    // message error
    public function messages()
    {
        return [
            'serial_number.required' => 'A serial_number is required',
            'type_id.required' => 'A type is required',
            'comment.required' => 'A comment is required',
        ];
    }


    // changes the standard error message response
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'name' => 'string|max:100',
            'image' => 'file|mimes:png,jpg,jpeg',
            'email' => 'email|unique:clients,email',
            'phones.*' => 'string|max:100',
            'phones' => 'array',
            'sellers.*' => 'integer|exists:sellers,id',
            'sellers' => 'array',
            'type_id' => 'exists:client_types,id'
        ];
    }

    public function messages(){
        return [
            'name.string' => 'The name field must be a string.',
            'name.max' => 'Maximum characters is 100 for the name field.',
            'image.file' => 'The image field must be a file.',
            'image.mimes' => 'Suported file extensions: png, jpg and jpeg.',
            'email.email' => 'A valid email is required.',
            'email.unique' => 'This email is in use.',
            'phones.*.string' => 'This phone number must be a string.',
            'phones.*.max' => 'Maximum string length for a phone is 100.',
            'sellers.*.exists' => 'Seller ID not found.',
            'type_id.exists' => 'Client type id not found. 1 for legal person 2 for legal entity',
        ];
    }
}

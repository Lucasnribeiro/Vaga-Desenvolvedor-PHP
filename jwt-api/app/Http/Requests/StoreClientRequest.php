<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // no user role based authorization needed, so just return true for this request
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
            'name' => 'required|string|max:100',
            'image' => 'file|mimes:png,jpg,jpeg',
            'email' => 'required|email|unique:clients,email',
            'phones.*' => 'string|max:100',
            'phones' => 'required|array|min:1',
            'sellers.*' => 'integer|exists:sellers,id',
            'sellers' => 'required|array|min:1',
            'type_id' => 'required|exists:client_types,id'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'A Client name is required.',
            'name.string' => 'The name field must be a string.',
            'name.max' => 'Maximum characters is 100 for the name field.',
            'image.file' => 'The image field must be a file.',
            'image.mimes' => 'Suported file extensions: png, jpg and jpeg.',
            'email.required' => 'A Client email is required',
            'email.email' => 'A valid email is required.',
            'email.unique' => 'This email is in use.',
            'phones.required' => 'At least one phone must be in the phones array.',
            'phones.*.string' => 'This phone number must be a string.',
            'phones.*.max' => 'Maximun string length for a phone is 100.',
            'sellers.required' => 'At least one seller ID must be assigned.',
            'sellers.*.exists' => 'Seller ID not found.',
            'type_id.required' => 'A Client type must be assigned.',
            'type_id.exists' => 'Client type id not found. 1 for legal person 2 for legal entity',
        ];
    }
}

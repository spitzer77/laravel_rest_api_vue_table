<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class EstateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|sting',
            'price' => 'nullable|integer',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'storeys' => 'nullable|integer',
            'garages' => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'price.integer'  => 'Price must be an integer',
            'bedrooms.integer' => 'Bedrooms must be an integer',
            'bathrooms.integer' => 'Bathrooms must be an integer',
            'storeys.integer' => 'Storeys must be an integer',
            'garages.integer' => 'Garages must be an integer'
        ];
    }


}

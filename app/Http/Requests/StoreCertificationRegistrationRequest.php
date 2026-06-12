<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCertificationRegistrationRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'association' => 'required|string|max:255',
            'firm_name' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'address' => 'required|string',
            'proprietor' => 'required|string|max:255',
            'mobile_primary' => 'required|string|max:20',
            'contact2_name' => 'nullable|string|max:255',
            'mobile_secondary' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'website' => 'nullable|url|max:255',
            'portal' => 'nullable|url|max:255',
            'companies_dealt_with' => 'required|string',
            'services_offered' => 'required|array|min:1',
        ];
    }
}

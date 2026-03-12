<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreStep1Request extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() && Auth::user()->isVendor();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'company_name' => 'required|string|max:255',
            'registration_number' => 'nullable|string|max:50',
            'tax_id' => 'nullable|string|max:50',
            'pan_number' => ['required', 'string', 'regex:/^[A-Z]{5}[0-9]{4}[A-Z]$/'],
            'business_type' => 'nullable|string|max:50',
            'contact_person' => 'required|string|max:255',
            'contact_phone' => ['required', 'string', 'regex:/^\+?[0-9]{10,15}$/'],
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'pincode' => ['required', 'string', 'regex:/^[0-9]{6}$/'],
        ];
    }

    public function messages(): array
    {
        return [
            'pan_number.regex' => 'PAN must be in the format ABCDE1234F (5 letters, 4 digits, 1 letter).',
            'contact_phone.regex' => 'Phone number must contain 10 to 15 digits, optionally prefixed with +.',
            'pincode.regex' => 'Pincode must be exactly 6 digits.',
        ];
    }
}

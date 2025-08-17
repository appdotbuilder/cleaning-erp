<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'pic' => 'required|string|max:255',
            'npwp' => 'nullable|string|max:20',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'payment_terms_days' => 'required|integer|min:0',
            'map_link' => 'nullable|url',
            'status' => 'required|in:active,inactive',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Supplier name is required.',
            'address.required' => 'Supplier address is required.',
            'phone.required' => 'Phone number is required.',
            'pic.required' => 'Point of Contact (PIC) is required.',
            'discount_percentage.required' => 'Discount percentage is required.',
            'discount_percentage.numeric' => 'Discount percentage must be a number.',
            'discount_percentage.min' => 'Discount percentage cannot be negative.',
            'discount_percentage.max' => 'Discount percentage cannot exceed 100%.',
            'payment_terms_days.required' => 'Payment terms (days) is required.',
            'payment_terms_days.integer' => 'Payment terms must be a whole number.',
            'payment_terms_days.min' => 'Payment terms cannot be negative.',
            'map_link.url' => 'Map link must be a valid URL.',
        ];
    }
}
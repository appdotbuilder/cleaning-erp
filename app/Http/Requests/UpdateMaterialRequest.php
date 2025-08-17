<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialRequest extends FormRequest
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
            'sku' => 'required|string|max:50|unique:materials,sku,' . $this->route('material')->id,
            'description' => 'nullable|string',
            'unit' => 'required|string|max:20',
            'unit_cost' => 'required|numeric|min:0',
            'current_stock' => 'required|numeric|min:0',
            'minimum_stock' => 'required|numeric|min:0',
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
            'name.required' => 'Material name is required.',
            'sku.required' => 'SKU is required.',
            'sku.unique' => 'This SKU is already in use by another material.',
            'unit.required' => 'Unit of measurement is required.',
            'unit_cost.required' => 'Unit cost is required.',
            'unit_cost.numeric' => 'Unit cost must be a number.',
            'unit_cost.min' => 'Unit cost cannot be negative.',
            'current_stock.required' => 'Current stock is required.',
            'current_stock.numeric' => 'Current stock must be a number.',
            'current_stock.min' => 'Current stock cannot be negative.',
            'minimum_stock.required' => 'Minimum stock is required.',
            'minimum_stock.numeric' => 'Minimum stock must be a number.',
            'minimum_stock.min' => 'Minimum stock cannot be negative.',
        ];
    }
}
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIncomeRequest extends FormRequest
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
            'income_category_id' => 'required|integer',
            'total' => 'required|numeric',
            'description' => 'required|string',
            'no_reference' => 'nullable|integer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'income_category_id.required' => 'Kategori pemasukan wajib diisi',
            'income_category_id.integer' => 'Kategori pemasukan wajib diisi',
            'total.required' => 'Total pemasukan wajib diisi',
            'description.required' => 'Deskripsi pemasukan wajib diisi',
        ];
    }
}

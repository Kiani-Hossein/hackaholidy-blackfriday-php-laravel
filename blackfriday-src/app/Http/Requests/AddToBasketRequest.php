<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class AddToBasketRequest extends FormRequest
{
    /**
     * @return true
     */
    public function authorize(): true
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'product-id' => 'required|exists:Products,asin',
            'user-id' => 'required',
            'basket-id' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'product-id.required' => 'شناسه محصول الزامی است.',
            'product-id.exists' => 'شناسه محصول نامعتبر است.',
            'user-id.required' => 'شناسه کاربر الزامی است.',
            'basket-id.required' => 'شناسه سبد الزامی است.',
        ];
    }
}

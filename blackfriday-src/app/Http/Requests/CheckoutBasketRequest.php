<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 *
 */
class CheckoutBasketRequest extends FormRequest
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
            'basket-id' => 'required|exists:Baskets,BasketId',
            'user-id' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'basket-id.required' => 'شناسه سبد خرید الزامی است.',
            'basket-id.exists' => 'شناسه سبد خرید نامعتبر است.',
            'user-id.required' => 'شناسه کاربر الزامی است.',
        ];
    }
}

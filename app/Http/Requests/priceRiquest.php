<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class priceRiquest extends FormRequest
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
           'price'=>'required|numeric|min:0',
            'product_id'=>'required|exists:products,id',
            "special_price"=>'nullable|numeric|min:0',
            'special_price_start'=>'required_with:special_price',
            'special_price_end'=>'required_with:special_price',
            'special_price_type'=>'required_with:special_price|in:fixed,percent',
        ];
    }
}

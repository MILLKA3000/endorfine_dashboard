<?php

namespace App\Http\Requests\Discounts;

use App\Http\Requests\Request;

class DiscountRequest extends Request
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
            'name' => 'required|min:3',
            'percent' => 'required|min:0|max:100|numeric'
        ];
    }
}

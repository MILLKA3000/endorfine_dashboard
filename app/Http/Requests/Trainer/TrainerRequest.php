<?php

namespace App\Http\Requests\Trainer;

use App\Http\Requests\Request;

class TrainerRequest extends Request
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
            'min' => 'required|min:0|numeric',
            'activityTime' => 'min:0|numeric',
            'value' => 'required|min:0|numeric',
        ];
    }
}

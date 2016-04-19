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
        $rules = [
            'name' => 'required|min:3',
            'min' => 'required|min:0|numeric',
            'percent' => 'min:0|max:100|numeric',
            'static' => 'min:0|numeric',

        ];
        foreach($this->request->get('array') as $key => $values)
        {
            $partOfName = 'array.' .$key;
            foreach ($values as $people => $value)
            {
                
                $rules[$partOfName .'.' .$people] = 'numeric|min:0';
                $rules[$partOfName .'.' .$value] = 'numeric|min:0';
            }

        }
        return $rules;

    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function messages()
    {
        return [
            'required' => 'Це поле не може бути пустим.',
            'min' => 'неповинно бути менше ніж :min символів',
        ];
    }
}

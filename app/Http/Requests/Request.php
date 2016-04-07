<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function messages()
    {
        return [
            'required' => 'Це поле не може бути пустим.',
            'min' => 'неповинно бути менше ніж :min',
            'max' => 'неповинно бути більше ніж :max',
            'image' => 'тип файлу не підтримується',
            'between' => 'Введіть від :min символів до :max',
            'alpha' => 'Поле повинно містити тільки літери',
            'alphaNum' => 'Поле повинно містити тільки літери та цифри'
        ];
    }
}

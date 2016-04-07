<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Options extends Request
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
            'title' => 'Required|Min:3|Max:80|AlphaNum',
            'next_birthdays' => 'Integer|Min:0|Max:360',
            'logo' => 'Image|max:15500',
        ];
    }
}

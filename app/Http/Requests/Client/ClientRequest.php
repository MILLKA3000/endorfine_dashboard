<?php

namespace App\Http\Requests\Client;

use App\Http\Requests\Request;

class ClientRequest extends Request
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
        if($this->ticket > 1 && $this->numTicket==null){
            return [
                'numTicket' => 'required|min:1|unique:numTicket'
            ];
        }

        return [
            'name' => 'required|min:3',
            'phone' => 'required',
            'numTicket' => 'unique:clientsToTickets|min:1'
        ];
    }
}

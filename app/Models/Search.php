<?php

namespace App\Models;

use App\Client;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    protected $enteredText;
   public function __construct($text)
   {
      $this->enteredText = $text;
   }

    public function searchResult(){
        $result = null;
        if (is_integer($this->enteredText)){
            if (strlen($this->enteredText)>5){
                $result = Client:: where('phone', 'like', "%$this->enteredText%")->get();
            }else {
//                $result = Client:: where('name', 'like', "%$this->enteredText%")->get();
            }
        } else{
            $clients = Client:: where('name', 'like', "%$this->enteredText%")->get();
            if(count($clients)>1){
                foreach ($clients as $client){
                    $result .= $this->makeListClients($client);
                }
            }
        }
        return $result;
    }


    private function makeListClients($clients){
        return view('search.listClients',compact('clients'));
    }
}

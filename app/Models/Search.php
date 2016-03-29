<?php

namespace App\Models;

use App\Client;
use App\ClientsToTickets;
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

        if (is_int((int)$this->enteredText)) {

            if (strlen($this->enteredText) > 5) {
                $clients = Client:: where('phone', 'like', "%$this->enteredText%")->get();
                if (count($clients) > 1) {
                    foreach ($clients as $client) {
                        $result .= $this->makeListClients($client);
                    }
                }
                if (count($clients) == 1) {
                    $numPhone = Client:: where('phone', $this->enteredText)->get()->first();
                    $result = $this->makeProfile($numPhone);
                }
            } else {
                $numAbonement = ClientsToTickets:: where('numTicket', $this->enteredText)->get()->first();
                $result = $this->makeProfile($numAbonement);
            }

        } else {
            $clients = Client:: where('name', 'like', "%$this->enteredText%")->get();
            if (count($clients) > 1) {
                foreach ($clients as $client) {
                    $result .= $this->makeListClients($client);
                }
            }
            if (count($clients) == 1) {
                $numPhone = Client:: where('name', $this->enteredText)->get()->first();
                $result = $this->makeProfile($numPhone);
            }
        }
        return $result;
    }
    private function makeProfile($numAbonement){
        return view('search.profile',compact('numAbonement'));
    }   

    private function makeListClients($clients){
        return view('search.listClients',compact('clients'));
    }
}

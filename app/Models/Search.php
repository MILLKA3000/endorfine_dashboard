<?php

namespace App\Models;

use App\Client;
use App\ClientsToTickets;

class Search
{
    protected $enteredText;

    public function __construct($text)
    {
        $this->enteredText = $text;
    }

    public function searchResult(){
        $result = null;
//        echo ($this->enteredText);
        if (is_numeric($this->enteredText)) {

            if (strlen($this->enteredText) >= 5 and ($this->enteredText[0]!='+')) {
                $phone = $this->phoneValidation($this->enteredText);
                $clients = Client:: where('phone', 'like', "%$phone%")->get();
                echo($phone);
                if (count($clients) > 1) {
                    foreach ($clients as $client) {
                        $result .= $this->makeListClients($client);
                    }
                }

                if (count($clients) == 1) {

                    $numAbonement = ClientsToTickets:: where('client_id', $clients->first()->id)->get()->first();
                    $result = $this->makeProfile($numAbonement);
                }
            } else {
                $numAbonement = ClientsToTickets:: where('numTicket', $this->enteredText)->get()->first();
//                $clients = Client::where('name', 'like', "%$this->enteredText%")->get();
                if(count($numAbonement)==1) {
                    $result = $this->makeProfile($numAbonement);
                }
            }

        } else {

            $clients = Client::where('name', 'like', "%$this->enteredText%")->get();
            if (count($clients) > 1) {
                foreach ($clients as $client) {
                    $result .= $this->makeListClients($client);
                }
            }

            if (count($clients) == 1) {
                $numAbonement = ClientsToTickets:: where('client_id', $clients->first()->id)->get()->first();
                $result = $this->makeProfile($numAbonement);
            }

        }
        return $result;
    }
    private function makeProfile($numAbonement){
        return view('search.profile',compact('numAbonement', 'client'));
    }   

    private function makeListClients($clients){
        return view('search.listClients',compact('clients'));
    }

    public function phoneValidation($phone){
        $validPhone='(';
        for($i=0; $i<strlen($phone); $i++){
            if ($i==3) {
                $validPhone.=') ';
            }
            if ($i==6) {
                $validPhone.='-';
            }
            if ($i==8) {
                $validPhone.='-';
            }
            $validPhone.= $phone[$i];
        }
        return $validPhone;
    }
}

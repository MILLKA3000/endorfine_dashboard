<?php

namespace App\Http\Controllers;
use App\Client;
use App\ClientsToTickets;
use App\Models\Events\EventModel;
use Illuminate\Http\Request;
use App\User;
use Hash;
use JWTAuth;
class APIController extends Controller
{

    /**
     * Авторизація юзера або кліента
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $input = $request->all();
        if (!$token = JWTAuth::attempt($input)) {
            if($this->validate_email($input['email'])==false){
                $client = $this->getClient($input);
                if ($client){
                    return response()->json(['result' => $client]);
                }
            }
            return response()->json(['result' => 'Ви ввели щось не вірно']);
        }
        return response()->json(['result' => $token]);
    }

    /**
     * Витягнути по токену інфо юзера
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_user_details(Request $request)
    {
        $input = $request->all();
        $user = JWTAuth::toUser($input['token']);
        return response()->json(['result' => $user]);
    }

    /**
     * Перевыряэ на ЕМЕЙЛ
     *
     * @param $email
     * @return bool
     */
    private function validate_email($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Витягнути всі дані по клієенту і його архів тренувань
     *
     * @param $input
     * @return mixed
     */
    private function getClient($input) {
        $id_client = ClientsToTickets::where('numTicket',$input['email'])->get()->first()->getNameClient->id;
        $client = Client::wherePhone($input['password'])->whereId($id_client)->get()->first();
        $event = new EventModel($client);
        $client->calendar = json_encode($event->getAllTrainingOfClient());
        return $client;
    }
}
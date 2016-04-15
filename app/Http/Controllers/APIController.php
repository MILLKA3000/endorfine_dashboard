<?php

namespace App\Http\Controllers;
use App\Client;
use App\ClientsToTickets;
use App\Models\Calendar\GetAllCalendarsModel;
use App\Models\Events\EventModel;
use App\TraningToTrainer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

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
            return response()->json(['result' => ['error' => 'Ви ввели щось не вірно']]);
        }
        return response()->json(['result' => ['data' => $token]]);
    }

    /**
     * Витягнути по токену інфо юзера
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_user_details(Request $request)
    {
        $input = $request->all();
        $from = (isset($input['start'])) ? $input['start'] : Carbon::now()->subDays(7);
        $to = (isset($input['end'])) ? $input['end'] : Carbon::now()->addDays(7);

        try {
            $trainer = JWTAuth::toUser($input['token']);
            $helperCalendar = new GetAllCalendarsModel();
            $trainer->training = TraningToTrainer::getTrainingFromTo($trainer,$from,$to);
            $trainer->events = json_encode($helperCalendar->getEventFromColections($trainer));
        }catch(\Exception  $e){
            return response()->json(['result' => ['error' => 'error response']]);
        }
        return response()->json(['result' => ['data' => $trainer]]);
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
        return false;
    }

    /**
     * Витягнути всі дані по клієенту і його архів тренувань
     *
     * @param $input
     * @return mixed
     */
    private function getClient($input) {
        try {
            $id_client = ClientsToTickets::where('numTicket', $input['email'])->get()->first()->getNameClient->id;
            $client = Client::wherePhone($input['password'])->whereId($id_client)->get()->first();
            $event = new EventModel($client);
            $client->calendar = json_encode($event->getAllTrainingOfClient());
        }catch(\Exception $e){
            return ['error'=>'Неможливо получити дані'];
        }
        return ['data' => $client];
    }
}
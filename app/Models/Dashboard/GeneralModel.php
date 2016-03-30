<?php

namespace App\Models\Dashboard;

use App\Client;
use App\ClientsToTickets;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GeneralModel extends Model{

    protected $options = ['addDays'=>7];

    /**
     * Конструктор для ініціалізації параметрів
     * @param array $options
     */
    public function __construct($options = []){
        $this->options = array_merge($this->options,$options);
    }

    /**
     * Витягає абонементи які будуть просрочені через 'addDays'=>7
     * @return mixed
     */
    public function getEndOfDateTickets(){
        $this->findOutstandingTickets();
        return ClientsToTickets::where('dateFromReserve','<=',Carbon::now()->addDays($this->options['addDays']))
            ->where('statusTicket_id','<',3)
            ->where('numTicket','!=','')
            ->where('dateFromReserve','!=','0000-00-00')
            ->limit(3)
            ->get();
    }

    /**
     * Автоматична перевірка для прострочених абонементів
     * @return mixed
     */
    public function findOutstandingTickets(){
        return ClientsToTickets::where('dateFromReserve','<',Carbon::now())
            ->where('dateFromReserve','!=','0000-00-00')
            ->where('statusTicket_id','<',3)
            ->update(['statusTicket_id'=>4]);
    }

    public function getBirthDayClient(){
        return Client::raw("SELECT name , birthday FROM client_info ORDER BY DAYOFYEAR(birthday) < DAYOFYEAR(CURDATE()), DAYOFYEAR(birthday)")->limit(3)->get();

    }

}

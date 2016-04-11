<?php namespace App\Services;

use Google_Client;
use Google_Service_Calendar_AclRule;
use Google_Service_Calendar_AclRuleScope;
use Google_Service_Calendar_Calendar;

use Illuminate\Support\Facades\Config;

class GoogleCalendar {

    protected $client;

    protected $service;

    function __construct() {
        $service_account_name = Config::get('google.service_account_name');
        $key_file_location = file_get_contents(base_path() . Config::get('google.key_file_location'));

        /* Add the scopes you need */
        $cred = new \Google_Auth_AssertionCredentials(
            $service_account_name,
            ['https://www.googleapis.com/auth/calendar'],
            $key_file_location
        );

        $client = new Google_Client();
        $client->setAssertionCredentials($cred);
        if ($client->getAuth()->isAccessTokenExpired()) {
            $client->getAuth()->refreshTokenWithAssertion();
        }
        $this->service = new \Google_Service_Calendar($client);


    }

    /**
     * Івенти з Гуглу
     *
     * @param $calendarId
     * @param $options
     * @return \Google_Service_Calendar_Events
     */
    public function getEvents($calendarId,$options)
    {
        $results = $this->service->events->listEvents($calendarId,$options);
        return ($results);
    }

    /**
     * Дані про календар
     *
     * @param $calendarId
     * @return Google_Service_Calendar_Calendar
     */
    public function get($calendarId)
    {
        $results = $this->service->calendars->get($calendarId);
        return ($results);
    }

    /**
     * ініціалізація календарів для тренера і продублювати для керівника філії owner роль для всіх
     *
     * @param $room
     * @param $trainer
     * @return mixed
     */
    public function setNewCalendar($room,$trainer)
    {
        $calendar = new Google_Service_Calendar_Calendar();
        $calendar->setSummary($trainer->name.":".$room->name);
        $calendar->setDescription($trainer->name.":".$room->name);
        $calendar->setTimeZone(Config::get('app.timezone'));
        $createdCalendar = $this->service->calendars->insert($calendar);

        $rule = new Google_Service_Calendar_AclRule();
        $scope = new Google_Service_Calendar_AclRuleScope();

        $scope->setType("user");
        $scope->setValue($trainer->email);
        $rule->setScope($scope);
        $rule->setRole("owner");

        $this->setCalendar($createdCalendar,$rule);
        $scope->setValue($room->getNameChapter->email);
        $this->setCalendar($createdCalendar,$rule);

        return ($createdCalendar->getId());
    }

    /**
     * Вставити календарі
     *
     * @param $createdCalendar
     * @param $rule
     */
    private function setCalendar($createdCalendar, $rule){
        try {
            $this->service->acl->insert($createdCalendar->getId(), $rule);
        }
        catch (\Exception $ex)
        {
            echo $ex->getMessage();
        }

    }
}
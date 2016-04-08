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

    public function getEvents($calendarId,$options)
    {
        $results = $this->service->events->listEvents($calendarId,$options);
        return ($results);
    }

    public function get($calendarId)
    {
        $results = $this->service->calendars->get($calendarId);
        return ($results);
    }

    public function setNewCalendar($name,$client)
    {
        $calendar = new Google_Service_Calendar_Calendar();
        $calendar->setSummary($name);
        $calendar->setDescription($name);
        $createdCalendar = $this->service->calendars->insert($calendar);

        $rule = new Google_Service_Calendar_AclRule();
        $scope = new Google_Service_Calendar_AclRuleScope();

        $scope->setType("user");
        $scope->setValue($client->email);
        $rule->setScope($scope);
        $rule->setRole("owner");

        $this->service->acl->insert($createdCalendar->getId(), $rule);
        $scope->setValue('endorfinefitness@gmail.com');
        $this->service->acl->insert($createdCalendar->getId(), $rule);

        return ($createdCalendar->getId());
    }
}
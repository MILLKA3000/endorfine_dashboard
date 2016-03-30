<?php
Route::model('user', 'App\User');
/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::auth();
    Route::get('/authorize', 'Auth\AuthController@handleProviderCallback');
    Route::group(['middleware' => 'auth'], function () {


        Route::get('/', 'HomeController@index');
        Route::post('/', 'SearchController@index');

        #Users
        Route::get('users/data', 'UsersController@data'); //for ajax table
        Route::get('users/{user}/show', 'UsersController@show');
        Route::get('users/{user}/edit', 'UsersController@edit');
        Route::get('users/{user}/delete', 'UsersController@delete');
        Route::resource('users', 'UsersController');

        #Roles
        Route::get('role/data', 'RolesController@data'); //for ajax table
        Route::get('role/{role}/show', 'RolesController@show');
        Route::get('role/{role}/edit', 'RolesController@edit');
        Route::put('role/{role}/edit', 'RolesController@update');
        Route::get('role/{role}/destroy', 'RolesController@destroy');
        Route::resource('role', 'RolesController');

        #Services
        Route::get('services/data', 'ServicesController@data'); //for ajax table
        Route::get('services/{status}/show', 'ServicesController@show');
        Route::get('services/{status}/edit', 'ServicesController@edit');
        Route::put('services/{status}/edit', 'ServicesController@update');
        Route::get('services/{status}/destroy', 'ServicesController@destroy');
        Route::resource('services', 'ServicesController');

        #StatusTickets
        Route::get('tickets/statuses/data', 'StatusTicketController@data'); //for ajax table
        Route::get('tickets/statuses/{status}/show', 'StatusTicketController@show');
        Route::get('tickets/statuses/{status}/edit', 'StatusTicketController@edit');
        Route::put('tickets/statuses/{status}/edit', 'StatusTicketController@update');
        Route::get('tickets/statuses/{status}/destroy', 'StatusTicketController@destroy');
        Route::resource('tickets/statuses', 'StatusTicketController');

        #StatusClient
        Route::get('clients/statuses/data', 'ClientStatusController@data'); //for ajax table
        Route::get('clients/statuses/{status}/show', 'ClientStatusController@show');
        Route::get('clients/statuses/{status}/edit', 'ClientStatusController@edit');
        Route::put('clients/statuses/{status}/edit', 'ClientStatusController@update');
        Route::get('clients/statuses/{status}/destroy', 'ClientStatusController@destroy');
        Route::resource('clients/statuses', 'ClientStatusController');

        #Clients
        Route::get('clients/data', 'ClientController@data'); //for ajax table
        Route::get('clients/getAllTickets/{client}', 'ClientController@getAllTickets'); //for ajax table
        Route::get('clients/getAllService/{client}', 'ClientController@getAllService'); //for ajax table
        Route::put('clients/{client}/edit', 'ClientController@update');

            #ClientToTickets
            Route::put('clients/{client}/saveTicketClient', 'ClientController@saveTicketClient');
            Route::get('clients/{activeTicket}/updateTicketClient', 'ClientController@editTicketClient');
            Route::put('clients/{activeTicket}/updateTicketClient', 'ClientController@updateTicketClient');
            Route::get('clients/{ticket}/destroyTicketClient', 'ClientController@destroyTicketClient');
            Route::get('clients/{client}/joinTicket', 'ClientController@joinTicket');

            #ClientToService
            Route::put('clients/{client}/saveServiceClient', 'ClientController@saveServiceClient');
            Route::get('clients/{service}/destroyServiceClient', 'ClientController@destroyServiceClient');
            Route::get('clients/{client}/joinService', 'ClientController@joinService');


        Route::get('clients/{client}/destroy', 'ClientController@destroy');
        Route::resource('clients', 'ClientController');


//        Route::post('photoPut', 'ClientController@getPhoto');

        #Discounts
        Route::get('discounts/data', 'DiscountsController@data'); //for ajax table
        Route::get('discounts/{discount}/edit', 'DiscountsController@edit');
        Route::put('discounts/{discount}/edit', 'DiscountsController@update');
        Route::get('discounts/{discount}/destroy', 'DiscountsController@destroy');
        Route::resource('discounts', 'DiscountsController');

        #Tickets
        Route::get('tickets/data', 'TicketsController@data'); //for ajax table
        Route::get('tickets/{ticket}/show', 'TicketsController@show');
        Route::get('tickets/{ticket}/edit', 'TicketsController@edit');
        Route::put('tickets/{ticket}/edit', 'TicketsController@update');
        Route::get('tickets/{ticket}/destroy', 'TicketsController@destroy');
        Route::resource('tickets', 'TicketsController');


        #Calendar
        Route::resource('calendar', 'Calendar\ForAdminController');

        #Events
        Route::post('/event/addEvents', 'EventsController@addEvents');


        #Search
        Route::post('/search', 'SearchController@search');
        Route::get('/search/graph', 'SearchController@graph');

        #System options
        Route::resource('options/', 'OptionsController');

    });
});



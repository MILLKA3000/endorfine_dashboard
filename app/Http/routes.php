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
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@index');

    # Users
    Route::get('users/data', 'UsersController@data'); //for ajax table
    Route::get('users/{user}/show', 'UsersController@show');
    Route::get('users/{user}/edit', 'UsersController@edit');
    Route::get('users/{user}/delete', 'UsersController@delete');
    Route::resource('users', 'UsersController');

    # StatusTickets
    Route::get('tickets/statuses/data', 'StatusTicketController@data'); //for ajax table
    Route::get('tickets/statuses/{status}/show', 'StatusTicketController@show');
    Route::get('tickets/statuses/{status}/edit', 'StatusTicketController@edit');
    Route::put('tickets/statuses/{status}/edit', 'StatusTicketController@update');
    Route::get('tickets/statuses/{status}/destroy', 'StatusTicketController@destroy');
    Route::resource('tickets/statuses', 'StatusTicketController');

    Route::resource('clients', 'ClientController');

});

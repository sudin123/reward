<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

$this->group(['middleware' => 'auth'], function() {
    $this->post('create-user', 'HomeController@createUser')->name('create-user');
    $this->get('/', 'HomeController@index')->name('home');
    $this->post('/', 'HomeController@store')->name('save-customer');
    $this->get('/{customer}', 'HomeController@destroy')->name('delete-customer');
    $this->get('customer/{customer}', 'HomeController@show')->name('show-customer');
    $this->group(['prefix' => 'points'], function() {
        $this->get('/use/{customer}', 'HomeController@usePoints')->name('use-points');
        $this->post('/use/{customer}', 'HomeController@savePointUsed')->name('save-used-points');
        $this->get('/{customer}', 'HomeController@showPoints')->name('show-points');
        $this->post('update', 'HomeController@updateRewardPoints')->name('update-points');
    });
});

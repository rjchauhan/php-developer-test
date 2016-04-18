<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('home', 'HomeController@index');

Route::resource('members', 'MemberController');
Route::resource('families', 'FamilyController');

Route::get('members/{member}/link-family', ['as' => 'members.link-family', 'uses' => 'MemberController@getLinkFamily']);
Route::post('members/{member}/link-family', 'MemberController@postLinkFamily');

Route::get('members/{member}/relation', ['as' => 'members.relation', 'uses' => 'MemberController@getRelation']);
Route::post('members/{member}/relation', 'MemberController@postRelation');

Route::get('family/tree/{member}', ['as' => 'family.tree', 'uses' => 'FamilyController@showTree']);

Route::get('members-vue', 'MemberController@indexVue');


/**
 * API Routes
 */
Route::group(['prefix' => 'api', 'namespace' => 'API'], function () {
    Route::get('members', 'MemberController@index');
    Route::post('members', 'MemberController@store');

    Route::get('families', 'FamilyController@index');
    Route::get('familyMembers/{member}', 'MemberController@familyMembers');

    Route::post('members/{member}/link-family', 'MemberController@linkFamily');
    Route::post('members/{member}/relation', 'MemberController@postRelation');
});
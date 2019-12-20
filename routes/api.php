<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/test/{id}','TestController@test');
Route::get('/groupsyllabus/create','TestController@create');
Route::get('/groupsyllabus/edit/{id}','TestController@edit');

//GroupSyllabus
Route::get('groupsyllabus/getall','GroupSyllabusController@getAll');
Route::post('groupsyllabus/create','GroupSyllabusController@create');
Route::post('groupsyllabus/edit/{id}','GroupSyllabusController@edit');
Route::delete('groupsyllabus/delete/{id}','GroupSyllabusController@delete');
Route::get('groupsyllabus/getlimit','GroupSyllabusController@getPaginate');
Route::get('groupsyllabus/findbyname/{name}','GroupSyllabusController@findByName');

//Syllabus
Route::get('syllabus/getall','SyllabusController@getAll');
Route::post('syllabus/create','SyllabusController@create');
Route::post('syllabus/edit/{id}','SyllabusController@edit');
Route::delete('syllabus/delete/{id}','SyllabusController@delete');
Route::get('syllabus/test','SyllabusController@test');
Route::get('syllabus/getobject','SyllabusController@getObject');
Route::get('syllabus/findbyname/{name}','SyllabusController@findByName');


//Projects
Route::get('project/getall','ProjectsController@getAll');
Route::post('project/create','ProjectsController@create');
Route::post('project/edit/{id}','ProjectsController@edit');
Route::delete('project/delete/{id}','ProjectsController@delete');

//Project Done
Route::get('projectdone/getall','ProjectDoneController@getAll');
Route::post('projectdone/create','ProjectDoneController@create');
Route::post('projectdone/edit/{id}','ProjectDoneController@edit');
Route::delete('projectdone/delete/{id}','ProjectDoneController@delete');

Route::middleware('auth:api')->get('/test-auth','TestController@testAuth');


//Users
Route::get('/users/getall','UsersController@getAll');
Route::get('/users/getpage','UsersController@getPage');
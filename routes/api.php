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
Route::get('/test','TestController@test');
Route::get('/groupsyllabus/create','TestController@create');
Route::get('/groupsyllabus/edit/{id}','TestController@edit');

//GroupSyllabus
Route::get('groupsyllabus/getall','GroupSyllabusController@getAll');
Route::post('groupsyllabus/create','GroupSyllabusController@create');
Route::post('groupsyllabus/edit','GroupSyllabusController@edit');
Route::delete('groupsyllabus/delete','GroupSyllabusController@delete');
Route::get('groupsyllabus/paginate','GroupSyllabusController@getPaginate');
Route::get('groupsyllabus/findbyname','GroupSyllabusController@findByName');

//Syllabus
Route::get('syllabus/getall','SyllabusController@getAll');
Route::post('syllabus/create','SyllabusController@create');
Route::post('syllabus/edit','SyllabusController@edit');
Route::delete('syllabus/delete','SyllabusController@delete');
Route::get('syllabus/test','SyllabusController@test');
Route::get('syllabus/paginategroupsyllabus','SyllabusController@getPaginateGroupSyllabus');
Route::get('syllabus/findbyname','SyllabusController@findByName');
Route::get('syllabus/paginatesyllabus','SyllabusController@getPaginateSyllabus');
Route::get('syllabus/getlistsyllabusbygroup','SyllabusController@getListSyllabusByGroup');
Route::get('syllabus/countsyllabus','SyllabusController@countSyllabus');


//Projects
Route::get('project/getall','ProjectsController@getAll');
Route::post('project/create','ProjectsController@create');
Route::post('project/edit','ProjectsController@edit');
Route::delete('project/delete','ProjectsController@delete');
Route::get('project/findbyname','ProjectsController@findByName');
Route::get('project/getlistproject','ProjectsController@getListProject');
Route::get('project/countprojects','ProjectsController@countProjects');
Route::get('project/finfbyid','ProjectsController@findById');

//Project Done
Route::get('projectdone/getall','ProjectDoneController@getAll');
Route::post('projectdone/create','ProjectDoneController@create');
Route::post('projectdone/edit','ProjectDoneController@edit');
Route::delete('projectdone/delete','ProjectDoneController@delete');

Route::middleware('auth:api')->get('/test-auth','TestController@testAuth');


//Users
Route::get('/users/getall','UsersController@getAll');
Route::get('/users/getPaginate','UsersController@getPaginate');
Route::get('/users/findbyname','UsersController@findByName');
Route::post('/users/edit','UsersController@edit');

Route::middleware('auth:api')->post('/users/updateProfile','UsersController@updateProfile');

Route::post('/users/create','UsersController@create');
Route::post('/register','Auth\RegisterController@apiRegister');
Route::delete('/users/delete','UsersController@delete');
Route::get('/users/countuser','UsersController@countUser');



Route::post('/pascal/compiler',function (Request $request){
    $client = new \GuzzleHttp\Client();
    if(!$request->code || $request->code == '') return null;
    $options = [
        'form_params' => [
            "code" => $request->code
        ]
    ];
    $request = $client->post('pascal:3000', $options);
    return $request->getBody();
});


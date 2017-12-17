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
//to day i will show you how to create some simple with ajax in your laravel application
//you need taskcontroller, task table and task model
Route::get('/', function () {
    return view('welcome');
});

Route::get('task/list', 'TaskController@index')->name('task.list');
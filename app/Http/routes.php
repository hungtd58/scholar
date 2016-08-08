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

/*Route::get('/', function () {
    return view('CiteSeerX');
});*/
Route::get('/', 'JSController@home');
Route::get('/search', 'JSController@search');
Route::get('/detail/{id}', 'JSController@detail');

Route::get('/data', 'ArticleController@data');
Route::post('/info', 'ArticleController@info');
Route::post('/detail', 'ArticleController@detail');
Route::get('/result', 'ArticleController@result');

Route::get('/gsarticles/{cluster_id}', 'GsArticleController@citation');
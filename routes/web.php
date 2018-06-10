<?php

//Home page
// Route::get('/', function () {
//     return view('home');
// });

//Detail pic
Route::get('/pic/{id}', 'HomeController@detailImage')->name('picdetail');

Route::get('/read', 'WallController@read');
// Auth::routes();

Route::match(['get', 'post'], '/', 'HomeController@index')->name('home');

//Delete pic
Route::get('/delete/pic/{id}', function ($id) {
    return view('welcome', ['id' => $id]);
});

// Route::get('/add/pic/', function () {
//     return view('welcome');
// });

Route::get('/form/pic', 'HomeController@formImage')->name("formpic");
Route::post('/add/pic', 'HomeController@addImage');
<?php

//Home page
Route::get('/', function () {
    return view('home');
});

//Detail pic
Route::get('/pic/{id}', function ($id) {
    return view('welcome', ['id' => $id]);
});

<<<<<<< HEAD
Route::get('/read', 'WallController@read');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
=======
//Delete pic
Route::get('/delete/pic/{id}', function ($id) {
    return view('welcome', ['id' => $id]);
});

// Route::get('/add/pic/', function () {
//     return view('welcome');
// });

Route::get('/add/pic', 'HomeController@addImage');
>>>>>>> Create page form pic

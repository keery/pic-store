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
// Route::get('/add/pic/', function () {
//     return view('welcome');
// });
Route::get('/form/pic', 'ImageController@formImage')->name("formpic");
Route::post('/add/pic', 'ImageController@addImage');
// Route::post('/my-pics', 'HomeController@index')->middleware('auth');
Route::get('/my-pics', 'ImageController@myPics')->name('my-pics');
// Route::get('/my-pics', ['middleware' => 'auth', function () {
//     return redirect()->route('home');
// }])->name('my-pics');
Route::get('/delete/pic/{id}', 'ImageController@destroy')->name('deletepic');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
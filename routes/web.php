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

Route::group(['middleware' => ['visitor']], function(){
    Route::get('/', function () {
        return view('frontend.login');
    })->name('home');


    
Route::get('/sign-up', 'Auth@signupPage')->name('signup');

Route::post('/sign-in', 'Auth@signin')->name('signin');
Route::post('/sign-up', 'Auth@signup')->name('signup');
});






Route::group(['middleware' => ['user']], function(){
    Route::any('/logout', 'Auth@logout')->name('logout');
    Route::get('/dashboard', 'Auth@dashboard')->name('dashboard');
    
    Route::get('/add-email-template', function () {
        return view('frontend.template.email');
    })->name('email-template');
    
    Route::post('/add-email-template', 'EmailTemplateController@save')->name('email-template');

    Route::get('/my-template', 'EmailTemplateController@allTemplate')->name('my-template');

});

// Route::get('/sign-in', 'Auth@signinPage')->name('signin');


Route::get('/sign-in', function(){
    return abort(404);
});




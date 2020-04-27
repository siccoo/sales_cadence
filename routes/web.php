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
    Route::get('/add-cadence', 'CadenceController@addCadence')->name('add.cadence');
    Route::post('/add-cadence', 'CadenceController@saveCadence')->name('add.cadence');

    

    Route::get('/add-step/{masked_id}', 'CadenceController@step')->name('step');
                                                                    
    Route::post('/email-step/{id}', 'EmailCadenceController@addStep')->name('email.step');

    Route::post('/sms-step/{id}', 'SmsCadenceController@addStep')->name('sms.step');

    Route::post('/save-cadence/{id}', 'CadenceController@saveAllCadence')->name('saveCadence');

    Route::get('/cadence-list', 'CadenceController@allcadence')->name('my.cadence');
    //LEAD ROUTES
    Route::get('leads/upload', 'LeadController@upload')->name('leads.upload');
    Route::post('leads/upload/post', 'LeadController@uploadPost')->name('leads.upload.post');
    Route::resource('leads', 'LeadController');

});

// Route::get('/sign-in', 'Auth@signinPage')->name('signin');


Route::get('/sign-in', function(){
    return abort(404);
});




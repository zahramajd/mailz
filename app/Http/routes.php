<?php


Route::get('/', function () {
    return redirect('/inbox');
});

Route::auth();

// Mail Controller

Route::get('/inbox/{tab?}', 'MailController@inbox');
Route::get('/read/{mail}', 'MailController@read');
Route::get('/delete/{mail}', 'MailController@delete');

Route::get('/profile', 'MailController@profile');
Route::post('/profile', 'MailController@profilePost');

Route::get('/contacts', 'MailController@contacts');

Route::get('/contacts/add/{user}', 'MailController@add');
Route::get('/contacts/reject/{user}', 'MailController@reject');


// Request

Route::post('/compose', 'MailController@compose');

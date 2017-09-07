<?php

Route::get('/', function () {
	if (Auth::check()){
		return redirect('home');
	} else {
    	return view('auth.login');
	}
});

Route::get('/verifyemail/{token}', 'Auth\RegisterController@verify');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::group(['prefix'=>'manage'], function() {
	Route::resource('users', 'UserController');
	//Route::resource('autoresponders', 'AutoresponderController');
	//Route::resource('packages', 'PackageController', ['except'=>['show']]);

});

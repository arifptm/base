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
	
	Route::get('products-list', 'ProductController@indexAdmin');
	Route::get('products/{$slug}', 'ProductController@show');
	Route::resource('products', 'ProductController', [ 'names' =>[
			'create' => 'create.product',
			'edit' => 'edit.product',
		]]);

	Route::get('accept-order/{id}','OrderController@acceptOrder');
	Route::get('reject-order/{id}','OrderController@rejectOrder');
	Route::resource('orders', 'OrderController', [ 'names' =>[
			'create' => 'create.order',
			'edit' => 'edit.order',
		]]);
	
	Route::resource('lineitems', 'LineitemController', [ 'names' =>[
			'create' => 'create.lineitem',
			'edit' => 'edit.lineitem',
			'store' => 'store.lineitem',
		]]);

	Route::get('roles/create-user-role', 'RoleController@createUserRole')->name('create.user.role');
	Route::post('roles/store', 'RoleController@storeUserRole');
	Route::post('roles/delete', 'RoleController@deleteUserRole');

	Route::resource('roles', 'RoleController', [ 'names' =>[
			'index' => 'index.roles',
			'create' => 'create.roles',
			'edit' => 'edit.roles',
			'store' => 'store.roles',
			'delete' => 'delete.roles',
		]]);	

});

Route::get('/products/data','ProductController@data')->name('products.data');

Route::post('lineitems','LineitemController@userStore')->name('user.store.lineitem');


Route::get('/products','ProductController@userIndex');
Route::get('/products/create','ProductController@userCreate');
Route::post('/products','ProductController@userStore');
Route::get('/products/{id}/edit','ProductController@userEdit')->name('user.edit.product');
Route::patch('/products/{id}','ProductController@userUpdate');
Route::delete('/products/{id}','ProductController@userDestroy');
Route::get('/products/{slug}','ProductController@userShow');

Route::get('/export-pdf/{id}', 'OrderController@userExportPdf');
Route::get('/orders', 'OrderController@userIndex');
Route::get('/orders/{id}', 'OrderController@userShow');



// Route::get('/images/s/{file}', function($file)
// {
//     $img = Image::make("assets/products/$file")
//     ->resize(null, 60, function($constraint){
//     	$constraint->aspectRatio();
//     });
//     return $img->response('jpg');
// });

Route::get('/images/s/{file}', function($file){
	$img = Image::cache(function($image) use ($file){
	    $image->make("assets/products/$file")
	    ->resize(null, 60, function($constraint){
     			$constraint->aspectRatio();
			});
	},3600,true);
	return $img->response();
});


Route::get('/images/profiles/b/{file}', function($file){
	$img = Image::cache(function($image) use ($file){
	    $image->make("assets/profiles/$file")
	    ->fit(400);
	},3600,true);
	return $img->response();
});


Route::get('tes', function(){

	return view('auth.user_confirmation_sent');
});

Route::get('bn', function(){
	Bouncer::allow('admin')->to('manage-users');
});
<?php
Route::group(['prefix' => 'business'], function () {
	Route::get('login', 'Business\LoginController@showLoginForm')->name('business.login');
    Route::post('login', 'Business\LoginController@login')->name('business.login.post');
	Route::get('logout', 'Business\LoginController@logout')->name('business.logout');

	Route::group(['middleware' => ['auth:business']], function () {
		Route::get('/', function () {
	      	return view('business.dashboard.index');
	    })->name('business.dashboard');

	    Route::group(['prefix'  =>   'event'], function() {
			Route::get('/', 'Business\EventController@index')->name('business.event.index');
			Route::get('/create', 'Business\EventController@create')->name('business.event.create');
			Route::post('/store', 'Business\EventController@store')->name('business.event.store');
			Route::get('/{id}/edit', 'Business\EventController@edit')->name('business.event.edit');
			Route::post('/update', 'Business\EventController@update')->name('business.event.update');
			Route::get('/{id}/delete', 'Business\EventController@delete')->name('business.event.delete');
			Route::get('/{id}/details', 'Business\EventController@details')->name('business.event.details');
		});

		Route::group(['prefix'  =>   'deal'], function() {
			Route::get('/', 'Business\DealController@index')->name('business.deal.index');
			Route::get('/create', 'Business\DealController@create')->name('business.deal.create');
			Route::post('/store', 'Business\DealController@store')->name('business.deal.store');
			Route::get('/{id}/edit', 'Business\DealController@edit')->name('business.deal.edit');
			Route::post('/update', 'Business\DealController@update')->name('business.deal.update');
			Route::get('/{id}/delete', 'Business\DealController@delete')->name('business.deal.delete');
			Route::get('/{id}/details', 'Business\DealController@details')->name('business.deal.details');
		});
	});
});
?>
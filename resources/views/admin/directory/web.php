<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

// Auth::routes();

Route::get('command', function () {
	/* php artisan migrate */
    \Artisan::call('migrate:fresh --seed');
    dd("Migration Done");
});

// Route::get('/', function() {
//     return view('frontend.index');
// });

Route::get('login', 'Admin\LoginController@showLoginForm')->name('login');

require 'admin.php';
require 'api.php';
require 'site.php';

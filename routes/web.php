<?php

header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

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

//Route::get('login', 'Admin\LoginController@showLoginForm')->name('login');

require 'admin.php';
require 'api.php';
require 'site.php';

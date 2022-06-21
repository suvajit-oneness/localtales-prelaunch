<?php
use Illuminate\Support\Facades\Route;

// Route::get('/','Site\HomeController@index')->name('site.home');
// Route::get('event-list','Site\EventController@index');
// Route::get('event-details/{id}/{slug}','Site\EventController@details');
// Route::get('deal-list','Site\DealController@index');
// Route::get('deal-details/{id}/{slug}','Site\DealController@details');

// Route::get('/search', 'Site\HomeController@search')->name('site.search');
// Route::get('local-loops','Site\LoopController@index');
// Route::get('blog-list','Site\BlogController@index');
 Route::get('article-details/{id}/{slug}','Site\ArticleController@details');
// Route::get('category-wise-blogs/{id}/{slug}','Site\BlogController@categoryWiseList');

    Route::get('login', 'Site\LoginController@showLoginForm')->name('site.login');
Route::post('site-login', 'Site\LoginController@login')->name('site.login.post');
Route::get('register', 'Site\LoginController@register')->name('site.register');
Route::post('site-register', 'Site\LoginController@userCreate')->name('site.register.post');
Route::get('site-logout', 'Site\LoginController@logout')->name('site.logout');

Route::group(['middleware' => ['auth:user']], function () {

		Route::get('/dashboard', function () {
	      	return view('site.dashboard.index');
	    })->name('site.dashboard');

	   Route::get('saved-collection','Site\DashboardController@savedCollection')->name('site.dashboard.saved_collection');
	    Route::get('/{id}/delete', 'Site\DashboardController@removeSavedCollection')->name('site.dashboard.collection.delete');
	    Route::get('saved-deals','Site\DashboardController@savedDeals')->name('site.dashboard.saved_deals');
	    Route::get('saved-deals/{id}/delete', 'Site\DashboardController@removeSavedDeals')->name('site.dashboard.deal.delete');
	    Route::get('saved-directory','Site\DashboardController@savedDirectories')->name('site.dashboard.saved_businesses');
	    Route::get('saved-directory/{id}/delete', 'Site\DashboardController@removeSavedDirectories')->name('site.dashboard.directory.delete');
	    Route::get('site-edit-profile', 'Site\DashboardController@editUserProfile')->name('site.dashboard.editProfile');
	    Route::post('site-update-profile', 'Site\DashboardController@updateProfile')->name('site.dashboard.updateProfile');
	    Route::get('notification-list', 'Site\DashboardController@notificationList')->name('site.dashboard.notificationList');

	    Route::post('site/comments/create', 'Site\LoopController@createComment')->name('site.comment.post');
	    Route::get('loop-like/{id}','Site\LoopController@loopLike');

	    Route::get('site-save-user-event/{id}','Site\EventController@saveUserEvent');
	    Route::get('site-delete-user-event/{id}','Site\EventController@deleteUserEvent');

	  
	    
    
	    
 	    
 	});
    Route::get('/search', 'Site\HomeController@search')->name('site.search');

Route::get('about-us','Site\ContentController@about')->name('about-us');
Route::get('contact-us','Site\ContentController@contact')->name('contact-us');
Route::get('terms-of-use','Site\ContentController@terms')->name('terms-of-use');
Route::get('privacy-policy','Site\ContentController@privacy')->name('privacy-policy');
Route::get('faq','Site\ContentController@faq')->name('faq');
Route::get('postcode','Site\ContentController@postcodeindex')->name('postcode-index');
Route::get('postcode/{pincode}','Site\ContentController@postcode')->name('postcode');
Route::get('suburb/{pincode}','Site\ContentController@suburb')->name('suburb');
Route::get('category/{id}','Site\ContentController@category')->name('category');
Route::get('category-index','Site\ContentController@categoryindex')->name('category-home');


Route::get('/', 'Front\IndexController@index')->name('index');

Route::get('/collection', 'Front\CollectionController@index')->name('collection.home');
Route::get('/collection-page/{id}', 'Front\IndexController@collection')->name('collection');
Route::get('/business-signup', 'Front\IndexController@businesssignup')->name('business.signup');
Route::get('/business-signup-page', 'Front\IndexController@businesssignuppage')->name('business.signup.page');
//Route::get('/thankyou', 'Front\IndexController@thankyou')->name('thankyou');
Route::post('/business/create', 'Front\IndexController@businessstore')->name('business.store');
Route::post('/business-signup/create', 'Front\IndexController@store')->name('business.signup.store');
Route::post('/business-signup-page/create', 'Front\IndexController@pagestore')->name('business.signuppage.store');
Route::get('directory/create-step-three', 'Front\IndexController@createStepThree')->name('products.create.step.three');
Route::post('directory/create-step-three', 'Front\IndexController@postCreateStepThree')->name('products.create.step.three.post');
Route::get('/article', 'Site\ArticleController@index')->name('article.index');
Route::get('search','Site\ArticleController@index')->name('site.search');
Route::get('directory-search','Site\ContentController@search')->name('directory.search');
Route::get('directory-list','Site\BusinessController@index');
Route::get('directory-details/{id}/{slug}','Site\BusinessController@details');
Route::get('directory-page/{id}/{slug}','Front\IndexController@page');

Route::get('category/{id?}/directory', 'Front\IndexController@categoryWiseDirectory')->name('category.directory');

Route::post('/review/create', 'Front\IndexController@reviewstore')->name('review');
  Route::get('site-save-user-directory/{id}','Site\BusinessController@saveUserBusiness');
  Route::get('site-delete-user-directory/{id}','Site\BusinessController@deleteUserBusiness');
   Route::get('site-save-user-collection/{id}','Front\IndexController@saveUserCollection');
	    Route::get('site-delete-user-collection/{id}','Front\IndexController@deleteUserCollection');
 
?>

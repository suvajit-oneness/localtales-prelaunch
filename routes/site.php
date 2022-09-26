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
// Route::get('category-wise-blogs/{id}/{slug}','Site\BlogController@categoryWiseList');

Route::get('article/{slug}','Site\ArticleController@details');
Route::get('login', 'Site\LoginController@showLoginForm')->name('site.login');
Route::post('site-login', 'Site\LoginController@login')->name('site.login.post');
Route::get('register', 'Site\LoginController@register')->name('site.register');
Route::post('site-register', 'Site\LoginController@userCreate')->name('site.register.post');
Route::get('site-logout', 'Site\LoginController@logout')->name('site.logout');

Route::group(['middleware' => ['auth:user']], function () {
    Route::get('/dashboard', 'Site\DashboardController@index')->name('site.dashboard');
    Route::get('saved-collection','Site\DashboardController@savedCollection')->name('site.dashboard.saved_collection');
    Route::get('/{id}/delete', 'Site\DashboardController@removeSavedCollection')->name('site.dashboard.collection.delete');
    Route::get('saved-deals','Site\DashboardController@savedDeals')->name('site.dashboard.saved_deals');
    Route::get('saved-deals/{id}/delete', 'Site\DashboardController@removeSavedDeals')->name('site.dashboard.deal.delete');
    Route::get('saved-directory','Site\DashboardController@savedDirectories')->name('site.dashboard.saved_businesses');
    Route::get('saved-directory/{id}/delete', 'Site\DashboardController@removeSavedDirectories')->name('site.dashboard.directory.delete');
    Route::get('site-edit-profile', 'Site\DashboardController@editUserProfile')->name('site.dashboard.editProfile');
    Route::post('site-update-profile', 'Site\DashboardController@updateProfile')->name('site.dashboard.updateProfile');
    Route::get('notification-list', 'Site\DashboardController@notificationList')->name('site.dashboard.notificationList');
    Route::get('setting', 'Site\DashboardController@setting')->name('site.dashboard.setting');
    Route::post('site/comments/create', 'Site\LoopController@createComment')->name('site.comment.post');
    Route::get('loop-like/{id}','Site\LoopController@loopLike');
    Route::get('site-save-user-event/{id}','Site\EventController@saveUserEvent');
    Route::get('site-delete-user-event/{id}','Site\EventController@deleteUserEvent');
});

Route::get('/search', 'Site\HomeController@search')->name('site.search');
Route::get('about-us','Site\ContentController@about')->name('about-us');
Route::get('contact-us','Site\ContentController@contact')->name('contact-us');
Route::get('terms','Site\ContentController@terms')->name('terms-of-use');
Route::get('privacy','Site\ContentController@privacy')->name('privacy-policy');
Route::get('faq','Site\ContentController@faq')->name('faq');
Route::get('postcode','Site\ContentController@postcodeindex')->name('postcode-index');
Route::get('postcode/{pincode}','Site\ContentController@postcode')->name('postcode');
//front suburb
Route::get('suburb','Site\SuburbController@index')->name('suburb-index');
Route::get('suburb/{slug}','Site\SuburbController@details')->name('suburb-details');

Route::get('category/{id}','Site\ContentController@category')->name('category');
Route::get('category','Site\ContentController@categoryindex')->name('category-home');
Route::get('/', 'Front\IndexController@index')->name('index');
Route::get('/collection', 'Front\CollectionController@index')->name('collection.home');

// old collection detail page with id & slug
Route::get('/collection/{id}/{slug}', 'Front\IndexController@collection')->name('collection');
// new collection detail page with id & slug
Route::get('/collection/{slug}', 'Front\IndexController@collectionUpdated')->name('collection');

Route::get('/business-signup', 'Front\IndexController@businesssignup')->name('business.signup');
Route::get('/business-signup-page/{id}', 'Front\IndexController@businesssignuppage')->name('business.signup.page');
Route::get('/business-registration', 'Front\IndexController@registrationform')->name('business.details');
//Route::get('/thankyou', 'Front\IndexController@thankyou')->name('thankyou');
Route::post('/business/create', 'Front\IndexController@businessstore')->name('business.store');
Route::post('/business/registration/form', 'Front\IndexController@store')->name('business.registration.store');
Route::post('/business-signup-page/create', 'Front\IndexController@pagestore')->name('business.signuppage.store');
Route::get('/thank-you', 'Front\IndexController@createStepThree')->name('products.create.step.three');
Route::post('directory/create-step-three', 'Front\IndexController@postCreateStepThree')->name('products.create.step.three.post');
Route::get('/article', 'Site\ArticleController@index')->name('article.index');
//article category
Route::get('/article/category/{slug}', 'Site\ArticleCategoryController@index')->name('article.category');
//article tag
Route::get('/article/tag/{tag}', 'Site\ArticleController@articletag')->name('article.tag');

Route::get('search','Site\ArticleController@index')->name('site.search');
Route::post('directory-search','Site\ContentController@search')->name('directory.search');
Route::get('directory-list-3','Site\BusinessController@index');
Route::get('directory-list-2','Site\BusinessController@index2');
Route::get('directory','Site\BusinessController@index3');
Route::post('directory/related','Site\BusinessController@relatedDirectory')->name('directory.related');
Route::get('directory/{id}/{slug}','Site\BusinessController@details');
Route::get('directory-page/{id}/{slug}','Front\IndexController@page');
Route::get('directory/{slug}','Site\BusinessController@detailsUpdated');
Route::get('category/{id?}/directory', 'Front\IndexController@categoryWiseDirectory')->name('category.directory');
Route::post('/review/create', 'Front\IndexController@reviewstore')->name('review');
Route::get('site-save-user-directory/{id}','Site\BusinessController@saveUserBusiness');
Route::get('site-delete-user-directory/{id}','Site\BusinessController@deleteUserBusiness');
Route::get('site-save-user-collection/{id}','Front\IndexController@saveUserCollection');
Route::get('site-delete-user-collection/{id}','Front\IndexController@deleteUserCollection');
Route::post('claim-user-collection/{id}','Front\HelpController@claimbusiness')->name('user.claim.business');
Route::post('/claim/ajax', 'Front\HelpController@claimAjax')->name('add.claim.ajax');
//Route::post('/search', 'Front\ContentController@search')->name('search');
Route::get('/raise/query','Front\QueryController@createQuery')->name('user.raise.query');
Route::post('/raise/query', 'Front\QueryController@storeQuery')->name('user.raise.query.store');
Route::post('/user/help/comment', 'Front\HelpController@store')->name('front.help.store');
Route::post('/add/ajax', 'Front\HelpController@helpAjax')->name('add.help.ajax');

// help
Route::name('front.help.')->prefix('help')->group(function() {
	Route::get('/', 'Front\HelpController@index')->name('index');
    Route::get('/subcat-detail/{id}/{slug}', 'Front\HelpController@subcat')->name('subcat');
	Route::get('/detail/{id}/{slug}', 'Front\HelpController@detail')->name('detail');
});

// directory categories ajax fetch
Route::post('/directory/category/ajax', 'Api\PostcodeController@category')->name('directory.category.ajax');
?>

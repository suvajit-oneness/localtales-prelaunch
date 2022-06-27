<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
	Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

	//admin password reset routes
    Route::post('/password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset','Admin\ResetPasswordController@reset');
    Route::get('/password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

	Route::get('/register', 'Admin\RegisterController@showRegistrationForm')->name('admin.register')->middleware('hasInvitation');
	Route::post('/register', 'Admin\RegisterController@register')->name('admin.register.post');

    Route::group(['middleware' => ['auth:admin']], function () {

	    
        Route::get('/dashboard', 'Admin\ProfileController@dashboard')->name('admin.dashboard');
		Route::get('/invite_list', 'Admin\InvitationController@index')->name('admin.invite');
	    Route::get('/invitation', 'Admin\InvitationController@create')->name('admin.invite.create');
		Route::post('/invitation', 'Admin\InvitationController@store')->name('admin.invitation.store');
		Route::get('/adminuser', 'Admin\AdminUserController@index')->name('admin.adminuser');
		Route::post('/adminuser', 'Admin\AdminUserController@updateAdminUser')->name('admin.adminuser.update');
	    Route::get('/settings', 'Admin\SettingController@index')->name('admin.settings');
		Route::post('/settings', 'Admin\SettingController@update')->name('admin.settings.update');

		Route::get('/profile', 'Admin\ProfileController@index')->name('admin.profile');
		Route::post('/profile', 'Admin\ProfileController@update')->name('admin.profile.update');
		Route::post('/changepassword', 'Admin\ProfileController@changePassword')->name('admin.profile.changepassword');

        /**  user management      **/
        Route::group(['prefix'  =>   'users'], function() {
			Route::get('/', 'Admin\UserManagementController@index')->name('admin.users.index');
			Route::post('/', 'Admin\UserManagementController@updateUser')->name('admin.users.post');
			Route::get('/{id}/delete', 'Admin\UserManagementController@delete')->name('admin.users.delete');
			Route::get('/{id}/view', 'Admin\UserManagementController@viewDetail')->name('admin.users.detail');
			Route::post('updateStatus', 'Admin\UserManagementController@updateStatus')->name('admin.users.updateStatus');
			Route::get('/{id}/details', 'Admin\UserManagementController@details')->name('admin.users.details');
		});
	
       //**  State management  **//
		Route::group(['prefix'  =>   'state'], function() {


        Route::get('/', 'Admin\StateManagementController@index')->name('admin.state.index');
        Route::get('/create', 'Admin\StateManagementController@create')->name('admin.state.create');
        Route::post('/store', 'Admin\StateManagementController@store')->name('admin.state.store');
        Route::get('/{id}/edit', 'Admin\StateManagementController@edit')->name('admin.state.edit');
        Route::post('/update', 'Admin\StateManagementController@update')->name('admin.state.update');
        Route::get('/{id}/delete', 'Admin\StateManagementController@delete')->name('admin.state.delete');
        Route::post('updateStatus', 'Admin\StateManagementController@updateStatus')->name('admin.state.updateStatus');
        Route::get('/{id}/details', 'Admin\StateManagementController@details')->name('admin.state.details');
        Route::post('/csv-store', 'Admin\StateManagementController@csvStore')->name('admin.state.data.csv.store');
        Route::get('/export', 'Admin\StateManagementController@export')->name('admin.state.data.csv.export');
    });
    //**  Pin code management   **/
    Route::group(['prefix'  =>   'pin'], function() {
        Route::get('/', 'Admin\PinCodeManagementController@index')->name('admin.pin.index');
        Route::get('/create', 'Admin\PinCodeManagementController@create')->name('admin.pin.create');
        Route::post('/store', 'Admin\PinCodeManagementController@store')->name('admin.pin.store');
        Route::get('/{id}/edit', 'Admin\PinCodeManagementController@edit')->name('admin.pin.edit');
        Route::post('/update', 'Admin\PinCodeManagementController@update')->name('admin.pin.update');
        Route::get('/{id}/delete', 'Admin\PinCodeManagementController@delete')->name('admin.pin.delete');
        Route::post('updateStatus', 'Admin\PinCodeManagementController@updateStatus')->name('admin.pin.updateStatus');
        Route::get('/{id}/details', 'Admin\PinCodeManagementController@details')->name('admin.pin.details');
        Route::post('/csv-store', 'Admin\PinCodeManagementController@csvStore')->name('admin.pincode.data.csv.store');
        Route::get('/export', 'Admin\PinCodeManagementController@export')->name('admin.pin.data.csv.export');
      });
        //**  Suburb management   **/


        Route::group(['prefix'  =>   'suburb'], function() {

        Route::get('/', 'Admin\SuburbManagementController@index')->name('admin.suburb.index');
        Route::get('/create', 'Admin\SuburbManagementController@create')->name('admin.suburb.create');
        Route::post('/store', 'Admin\SuburbManagementController@store')->name('admin.suburb.store');
        Route::get('/{id}/edit', 'Admin\SuburbManagementController@edit')->name('admin.suburb.edit');
        Route::post('/update', 'Admin\SuburbManagementController@update')->name('admin.suburb.update');
        Route::get('/{id}/delete', 'Admin\SuburbManagementController@delete')->name('admin.suburb.delete');
        Route::post('updateStatus', 'Admin\SuburbManagementController@updateStatus')->name('admin.suburb.updateStatus');
        Route::get('/{id}/details', 'Admin\SuburbManagementController@details')->name('admin.suburb.details');
        Route::post('/csv-store', 'Admin\SuburbManagementController@csvStore')->name('admin.suburb.data.csv.store');
        Route::get('/export', 'Admin\SuburbManagementController@export')->name('admin.suburb.data.csv.export');
    });
        //**  Category management   **/
		Route::group(['prefix'  =>   'category'], function() {



        Route::get('/', 'Admin\CategoryManagementController@index')->name('admin.category.index');
        Route::get('/create', 'Admin\CategoryManagementController@create')->name('admin.category.create');
        Route::post('/store', 'Admin\CategoryManagementController@store')->name('admin.category.store');
        Route::get('/{id}/edit', 'Admin\CategoryManagementController@edit')->name('admin.category.edit');
        Route::post('/update', 'Admin\CategoryManagementController@update')->name('admin.category.update');
        Route::get('/{id}/delete', 'Admin\CategoryManagementController@delete')->name('admin.category.delete');
        Route::post('updateStatus', 'Admin\CategoryManagementController@updateStatus')->name('admin.category.updateStatus');
        Route::get('/{id}/details', 'Admin\CategoryManagementController@details')->name('admin.category.details');
        Route::post('/csv-store', 'Admin\CategoryManagementController@csvStore')->name('admin.category.data.csv.store');
        Route::get('/export', 'Admin\CategoryManagementController@export')->name('admin.category.data.csv.export');
    });
        //**  Sub category management  **/
		Route::group(['prefix'  =>   'subcategory'], function() {



        Route::get('/', 'Admin\SubCategoryManagementController@index')->name('admin.subcategory.index');
        Route::get('/create', 'Admin\SubCategoryManagementController@create')->name('admin.subcategory.create');
        Route::post('/store', 'Admin\SubCategoryManagementController@store')->name('admin.subcategory.store');
        Route::get('/{id}/edit', 'Admin\SubCategoryManagementController@edit')->name('admin.subcategory.edit');
        Route::post('/update', 'Admin\SubCategoryManagementController@update')->name('admin.subcategory.update');
        Route::get('/{id}/delete', 'Admin\SubCategoryManagementController@delete')->name('admin.subcategory.delete');
        Route::post('updateStatus', 'Admin\SubCategoryManagementController@updateStatus')->name('admin.subcategory.updateStatus');
        Route::get('/{id}/details', 'Admin\SubCategoryManagementController@details')->name('admin.subcategory.details');
        Route::post('/csv-store', 'Admin\SubCategoryManagementController@csvStore')->name('admin.subcategory.data.csv.store');
        Route::get('/export', 'Admin\SubCategoryManagementController@export')->name('admin.subcategory.data.csv.export');
    });
        //**  Sub category level2 management  **/
		Route::group(['prefix'  =>   'sub-category-level2'], function() {


        Route::get('/', 'Admin\SubCategoryLevelController@index')->name('admin.sub-category-level2.index');
        Route::get('/create', 'Admin\SubCategoryLevelController@create')->name('admin.sub-category-level2.create');
        Route::post('/store', 'Admin\SubCategoryLevelController@store')->name('admin.sub-category-level2.store');
        Route::get('/{id}/edit', 'Admin\SubCategoryLevelController@edit')->name('admin.sub-category-level2.edit');
        Route::post('/update', 'Admin\SubCategoryLevelController@update')->name('admin.sub-category-level2.update');
        Route::get('/{id}/delete', 'Admin\SubCategoryLevelController@delete')->name('admin.sub-category-level2.delete');
        Route::post('updateStatus', 'Admin\SubCategoryLevelController@updateStatus')->name('admin.sub-category-level2.updateStatus');
        Route::get('/{id}/details', 'Admin\SubCategoryLevelController@details')->name('admin.sub-category-level2.details');
        Route::post('/csv-store', 'Admin\SubCategoryLevelController@csvStore')->name('admin.sub-category-level2.data.csv.store');
        Route::get('/export', 'Admin\SubCategoryLevelController@export')->name('admin.sub-category-level2.data.csv.export');
    });



     //**  blog management  **/
		Route::group(['prefix'  =>   'blog'], function() {


            Route::get('/', 'Admin\BlogController@index')->name('admin.blog.index');
            Route::get('/create', 'Admin\BlogController@create')->name('admin.blog.create');
            Route::post('/store', 'Admin\BlogController@store')->name('admin.blog.store');
            Route::get('/{id}/edit', 'Admin\BlogController@edit')->name('admin.blog.edit');
            Route::post('/update', 'Admin\BlogController@update')->name('admin.blog.update');
            Route::get('/{id}/delete', 'Admin\BlogController@delete')->name('admin.blog.delete');
            Route::post('updateStatus', 'Admin\BlogController@updateStatus')->name('admin.blog.updateStatus');
            Route::get('/{id}/details', 'Admin\BlogController@details')->name('admin.blog.details');
            Route::post('/csv-store', 'Admin\BlogController@csvStore')->name('admin.blog.data.csv.store');
            Route::get('/export', 'Admin\BlogController@export')->name('admin.blog.data.csv.export');
        });

     //**  Directory management  **/
		Route::group(['prefix'  =>   'directory'], function() {
            Route::get('/', 'Admin\DirectoryController@index')->name('admin.directory.index');
            Route::get('/create', 'Admin\DirectoryController@create')->name('admin.directory.create');
            Route::post('/store', 'Admin\DirectoryController@store')->name('admin.directory.store');
            Route::get('/{id}/edit', 'Admin\DirectoryController@edit')->name('admin.directory.edit');
            Route::post('/update', 'Admin\DirectoryController@update')->name('admin.directory.update');
            Route::get('/{id}/delete', 'Admin\DirectoryController@delete')->name('admin.directory.delete');
            Route::post('updateStatus', 'Admin\DirectoryController@updateStatus')->name('admin.directory.updateStatus');
            Route::get('/{id}/details', 'Admin\DirectoryController@details')->name('admin.directory.details');
            Route::post('/csv-store', 'Admin\DirectoryController@csvStore')->name('admin.directory.data.csv.store');
            Route::get('/export', 'Admin\DirectoryController@export')->name('admin.directory.data.csv.export');
            Route::get('/fix', 'Admin\DirectoryController@dataFix')->name('admin.directory.data.fix');
            Route::get('/fix/rating', 'Admin\DirectoryController@dataFixrating')->name('admin.directory.data.fix.rating');
        });

        //**  Collection management  **/
		Route::group(['prefix'  =>   'collection'], function() {


            Route::get('/', 'Admin\CollectionController@index')->name('admin.collection.index');
            Route::get('/create', 'Admin\CollectionController@create')->name('admin.collection.create');
            Route::post('/store', 'Admin\CollectionController@store')->name('admin.collection.store');
            Route::get('/{id}/edit', 'Admin\CollectionController@edit')->name('admin.collection.edit');
            Route::post('/update', 'Admin\CollectionController@update')->name('admin.collection.update');
            Route::get('/{id}/delete', 'Admin\CollectionController@delete')->name('admin.collection.delete');
            Route::post('updateStatus', 'Admin\CollectionController@updateStatus')->name('admin.collection.updateStatus');
            Route::get('/{id}/details', 'Admin\CollectionController@details')->name('admin.collection.details');
            Route::post('/csv-store', 'Admin\CollectionController@csvStore')->name('admin.collection.data.csv.store');
            Route::get('/export', 'Admin\CollectionController@export')->name('admin.collection.data.csv.export');
        });



        //**  Directory-Collection management  **/
		Route::group(['prefix'  =>   'collectiondir'], function() {


            Route::get('/', 'Admin\DirectoryCollectionController@index')->name('admin.collectiondir.index');
            Route::get('/create', 'Admin\DirectoryCollectionController@create')->name('admin.collectiondir.create');
            Route::post('/store', 'Admin\DirectoryCollectionController@store')->name('admin.collectiondir.store');
            Route::get('/{id}/edit', 'Admin\DirectoryCollectionController@edit')->name('admin.collectiondir.edit');
            Route::post('/update', 'Admin\DirectoryCollectionController@update')->name('admin.collectiondir.update');
            Route::get('/{id}/delete', 'Admin\DirectoryCollectionController@delete')->name('admin.collectiondir.delete');
            Route::post('updateStatus', 'Admin\DirectoryCollectionController@updateStatus')->name('admin.collectiondir.updateStatus');
            Route::get('/{id}/details', 'Admin\DirectoryCollectionController@details')->name('admin.collectiondir.details');
            Route::post('/csv-store', 'Admin\DirectoryCollectionController@csvStore')->name('admin.collectiondir.data.csv.store');
            Route::get('/export', 'Admin\DirectoryCollectionController@export')->name('admin.collectiondir.data.csv.export');
            
        });



        //**  Directory-Collection management  **/
		Route::group(['prefix'  =>   'dircategory'], function() {


            Route::get('/', 'Admin\DirectoryCategoryController@index')->name('admin.dircategory.index');
            Route::get('/create', 'Admin\DirectoryCategoryController@create')->name('admin.dircategory.create');
            Route::post('/store', 'Admin\DirectoryCategoryController@store')->name('admin.dircategory.store');
            Route::get('/{id}/edit', 'Admin\DirectoryCategoryController@edit')->name('admin.dircategory.edit');
            Route::post('/update', 'Admin\DirectoryCategoryController@update')->name('admin.dircategory.update');
            Route::get('/{id}/delete', 'Admin\DirectoryCategoryController@delete')->name('admin.dircategory.delete');
            Route::post('updateStatus', 'Admin\DirectoryCategoryController@updateStatus')->name('admin.dircategory.updateStatus');
            Route::get('/{id}/details', 'Admin\DirectoryCategoryController@details')->name('admin.dircategory.details');
            Route::post('/csv-store', 'Admin\DirectoryCategoryController@csvStore')->name('admin.dircategory.data.csv.store');
            Route::get('/export', 'Admin\DirectoryCategoryController@export')->name('admin.dircategory.data.csv.export');
        });


         //**  Bussiness Lead management  **/
		Route::group(['prefix'  =>   'bussinesslead'], function() {


            Route::get('/', 'Admin\BussinessLeadController@index')->name('admin.bussinesslead.index');
            Route::get('/create', 'Admin\BussinessLeadController@create')->name('admin.bussinesslead.create');
            Route::post('/store', 'Admin\BussinessLeadController@store')->name('admin.bussinesslead.store');
            Route::get('/{id}/edit', 'Admin\BussinessLeadController@edit')->name('admin.bussinesslead.edit');
            Route::post('/update', 'Admin\BussinessLeadController@update')->name('admin.bussinesslead.update');
            Route::get('/{id}/delete', 'Admin\BussinessLeadController@delete')->name('admin.bussinesslead.delete');
            Route::post('updateStatus', 'Admin\BussinessLeadController@updateStatus')->name('admin.bussinesslead.updateStatus');
            Route::get('/{id}/details', 'Admin\BussinessLeadController@details')->name('admin.bussinesslead.details');
            Route::post('/csv-store', 'Admin\BussinessLeadController@csvStore')->name('admin.bussinesslead.data.csv.store');
            Route::get('/export', 'Admin\BussinessLeadController@export')->name('admin.bussinesslead.data.csv.export');
        });



        // settings
        Route::group(['prefix'  =>   'settings'], function() {
            Route::get('/', 'Admin\SettingController@index')->name('admin.settings.index');
            Route::post('/store', 'Admin\SettingController@store')->name('admin.settings.store');
            Route::get('/{id}/view', 'Admin\SettingController@show')->name('admin.settings.view');
            Route::post('/update', 'Admin\SettingController@update')->name('admin.settings.update');
            Route::post('updateStatus', 'Admin\SettingController@updateStatus')->name('admin.settings.updateStatus');
            Route::get('/{id}/delete', 'Admin\SettingController@destroy')->name('admin.settings.delete');
        });

        //about-us

        Route::group(['prefix'  =>   'about-us'], function() {

            Route::get('/', 'Admin\AboutManagementController@index')->name('admin.about-us.index');
            Route::get('/create', 'Admin\AboutManagementController@create')->name('admin.about-us.create');
            Route::post('/store', 'Admin\AboutManagementController@store')->name('admin.about-us.store');
            Route::get('/{id}/edit', 'Admin\AboutManagementController@edit')->name('admin.about-us.edit');
            Route::post('/update', 'Admin\AboutManagementController@update')->name('admin.about-us.update');
            Route::get('/{id}/delete', 'Admin\AboutManagementController@delete')->name('admin.about-us.delete');
            Route::post('updateStatus', 'Admin\AboutManagementController@updateStatus')->name('admin.about-us.updateStatus');
            Route::get('/{id}/details', 'Admin\AboutManagementController@details')->name('admin.about-us.details');
            Route::post('/csv-store', 'Admin\AboutManagementController@csvStore')->name('admin.about-us.data.csv.store');
        });

        //contact-us

        Route::group(['prefix'  =>   'contact-us'], function() {

            Route::get('/', 'Admin\ContactManagementController@index')->name('admin.contact-us.index');
            Route::get('/create', 'Admin\ContactManagementController@create')->name('admin.contact-us.create');
            Route::post('/store', 'Admin\ContactManagementController@store')->name('admin.contact-us.store');
            Route::get('/{id}/edit', 'Admin\ContactManagementController@edit')->name('admin.contact-us.edit');
            Route::post('/update', 'Admin\ContactManagementController@update')->name('admin.contact-us.update');
            Route::get('/{id}/delete', 'Admin\ContactManagementController@delete')->name('admin.contact-us.delete');
            Route::post('updateStatus', 'Admin\ContactManagementController@updateStatus')->name('admin.contact-us.updateStatus');
            Route::get('/{id}/details', 'Admin\ContactManagementController@details')->name('admin.contact-us.details');
            Route::post('/csv-store', 'Admin\ContactManagementController@csvStore')->name('admin.contact-us.data.csv.store');
        });

        //faq

        Route::group(['prefix'  =>   'faq'], function() {

            Route::get('/', 'Admin\FaqManagementController@index')->name('admin.faq.index');
            Route::get('/create', 'Admin\FaqManagementController@create')->name('admin.faq.create');
            Route::post('/store', 'Admin\FaqManagementController@store')->name('admin.faq.store');
            Route::get('/{id}/edit', 'Admin\FaqManagementController@edit')->name('admin.faq.edit');
            Route::post('/update', 'Admin\FaqManagementController@update')->name('admin.faq.update');
            Route::get('/{id}/delete', 'Admin\FaqManagementController@delete')->name('admin.faq.delete');
            Route::post('updateStatus', 'Admin\FaqManagementController@updateStatus')->name('admin.faq.updateStatus');
            Route::get('/{id}/details', 'Admin\FaqManagementController@details')->name('admin.faq.details');
            Route::post('/csv-store', 'Admin\FaqManagementController@csvStore')->name('admin.faq.data.csv.store');
        });
//faq module

Route::group(['prefix'  =>   'faqmodule'], function() {

    Route::get('/', 'Admin\FaqController@index')->name('admin.faqmodule.index');
    Route::get('/create', 'Admin\FaqController@create')->name('admin.faqmodule.create');
    Route::post('/store', 'Admin\FaqController@store')->name('admin.faqmodule.store');
    Route::get('/{id}/edit', 'Admin\FaqController@edit')->name('admin.faqmodule.edit');
    Route::post('/update', 'Admin\FaqController@update')->name('admin.faqmodule.update');
    Route::get('/{id}/delete', 'Admin\FaqController@delete')->name('admin.faqmodule.delete');
    Route::post('updateStatus', 'Admin\FaqController@updateStatus')->name('admin.faqmodule.updateStatus');
    Route::get('/{id}/details', 'Admin\FaqController@details')->name('admin.faqmodule.details');
    Route::post('/csv-store', 'Admin\FaqController@csvStore')->name('admin.faqmodule.data.csv.store');
    Route::get('/export', 'Admin\FaqController@export')->name('admin.faqmodule.data.csv.export');
    
});

        //splash

        Route::group(['prefix'  =>   'splash'], function() {

            Route::get('/', 'Admin\IndexManagementController@index')->name('admin.splash.index');
            Route::get('/create', 'Admin\IndexManagementController@create')->name('admin.splash.create');
            Route::post('/store', 'Admin\IndexManagementController@store')->name('admin.splash.store');
            Route::get('/{id}/edit', 'Admin\IndexManagementController@edit')->name('admin.splash.edit');
            Route::post('/update', 'Admin\IndexManagementController@update')->name('admin.splash.update');
            Route::get('/{id}/delete', 'Admin\IndexManagementController@delete')->name('admin.splash.delete');
            Route::post('updateStatus', 'Admin\IndexManagementController@updateStatus')->name('admin.splash.updateStatus');
            Route::get('/{id}/details', 'Admin\IndexManagementController@details')->name('admin.splash.details');
            Route::post('/csv-store', 'Admin\IndexManagementController@csvStore')->name('admin.splash.data.csv.store');
        });

         //frontend-collection

         Route::group(['prefix'  =>   'forntendcollection'], function() {

            Route::get('/', 'Admin\CollectionManagementController@index')->name('admin.forntendcollection.index');
            Route::get('/create', 'Admin\CollectionManagementController@create')->name('admin.forntendcollection.create');
            Route::post('/store', 'Admin\CollectionManagementController@store')->name('admin.forntendcollection.store');
            Route::get('/{id}/edit', 'Admin\CollectionManagementController@edit')->name('admin.forntendcollection.edit');
            Route::post('/update', 'Admin\CollectionManagementController@update')->name('admin.forntendcollection.update');
            Route::get('/{id}/delete', 'Admin\CollectionManagementController@delete')->name('admin.forntendcollection.delete');
            Route::post('updateStatus', 'Admin\CollectionManagementController@updateStatus')->name('admin.forntendcollection.updateStatus');
            Route::get('/{id}/details', 'Admin\CollectionManagementController@details')->name('admin.forntendcollection.details');
            Route::post('/csv-store', 'Admin\CollectionManagementController@csvStore')->name('admin.forntendcollection.data.csv.store');
        });
	
		Route::group(['prefix'  =>   'event'], function() {
			Route::get('/', 'Admin\EventController@index')->name('admin.event.index');
			Route::get('/create', 'Admin\EventController@create')->name('admin.event.create');
			Route::post('/store', 'Admin\EventController@store')->name('admin.event.store');
			Route::get('/{id}/edit', 'Admin\EventController@edit')->name('admin.event.edit');
			Route::post('/update', 'Admin\EventController@update')->name('admin.event.update');
			Route::get('/{id}/delete', 'Admin\EventController@delete')->name('admin.event.delete');
			Route::post('updateStatus', 'Admin\EventController@updateStatus')->name('admin.event.updateStatus');
			Route::get('/{id}/details', 'Admin\EventController@details')->name('admin.event.details');
		});

		Route::group(['prefix'  =>   'deal'], function() {
			Route::get('/', 'Admin\DealController@index')->name('admin.deal.index');
			Route::get('/create', 'Admin\DealController@create')->name('admin.deal.create');
			Route::post('/store', 'Admin\DealController@store')->name('admin.deal.store');
			Route::get('/{id}/edit', 'Admin\DealController@edit')->name('admin.deal.edit');
			Route::post('/update', 'Admin\DealController@update')->name('admin.deal.update');
			Route::get('/{id}/delete', 'Admin\DealController@delete')->name('admin.deal.delete');
			Route::post('updateStatus', 'Admin\DealController@updateStatus')->name('admin.deal.updateStatus');
			Route::get('/{id}/details', 'Admin\DealController@details')->name('admin.deal.details');
		});

	

	});

});
?>

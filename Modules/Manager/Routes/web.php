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

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    Route::prefix('managerDashboard')->group(function () {

        Route::get('/', 'ManagerController@home')->name('manager.home');

        Route::prefix('manager')->group(function () {
            Route::get('/', 'ManagerController@index')->name('manager.index');
            Route::get('/create', 'ManagerController@create')->name('manager.create');
            Route::get('/edite', 'ManagerController@edite')->name('manager.edite');
        });

        Route::prefix('chefassistant')->group(function () {
            Route::get('/', 'ChefAssistantsController@index')->name('chefassistant.index');
            Route::get('/create', 'ChefAssistantsController@create')->name('chefassistant.create');
            Route::post('/store', 'ChefAssistantsController@store')->name('chefassistant.store');

            Route::get('/edit/{id}', 'ChefAssistantsController@edit')->name('chefassistant.edit');
            Route::post('/update/{id}', 'ChefAssistantsController@update')->name('chefassistant.update');

            Route::get('/destroy/{id}', 'ChefAssistantsController@destroy')->name('chefassistant.destroy');
        });
        Route::prefix('branch')->group(function () {
            Route::get('/', 'BranchsController@index')->name('branch.index');
            Route::get('/create', 'BranchsController@create')->name('branch.create');
            Route::post('/store', 'BranchsController@store')->name('branch.store');
            Route::get('/edit/{id}', 'BranchsController@edit')->name('branch.edit');
            Route::post('/update/{id}', 'BranchsController@update')->name('branch.update');
            Route::get('/destroy/{id}', 'BranchsController@destroy')->name('branch.destroy');
        });

        Route::prefix('cashier')->group(function () {
            Route::get('/', 'CashiersController@index')->name('cashier.index');
            Route::get('/create', 'CashiersController@create')->name('cashier.create');
            Route::post('/store', 'CashiersController@store')->name('cashier.store');
            Route::post('/update/{id}', 'CashiersController@update')->name('cashier.update');
            Route::get('/edit/{id}', 'CashiersController@edit')->name('cashier.edit');
            Route::get('/cashier/{id}', 'CashiersController@destroy')->name('cashier.destroy');
        });
        Route::prefix('categories')->group(function () {
            Route::get('/', 'CategoriesController@index')->name('category.index');
            Route::get('/create', 'CategoriesController@create')->name('category.create');
            Route::post('/store', 'CategoriesController@store')->name('category.store');
            Route::get('/edit/{id}', 'CategoriesController@edit')->name('category.edit');
            Route::post('/update/{id}', 'CategoriesController@update')->name('category.update');
            Route::get('/destroy/{id}', 'CategoriesController@destroy')->name('category.destroy');
        });
        Route::prefix('chef')->group(function () {
            Route::get('/', 'ChefsController@index')->name('chef.index');
            Route::get('/create', 'ChefsController@create')->name('chef.create');
            Route::post('/store', 'ChefsController@store')->name('chef.store');
            Route::get('/edit/{id}', 'ChefsController@edit')->name('chef.edit');
            Route::post('/update/{id}', 'ChefsController@update')->name('chef.update');
            Route::get('/destroy/{id}', 'ChefsController@destroy')->name('chef.destroy');
        });
        Route::prefix('deliveryboy')->group(function () {
            Route::get('/', 'DeliveryBoysController@index')->name('deliveryboy.index');
            Route::get('/create', 'DeliveryBoysController@create')->name('deliveryboy.create');
            Route::post('/store', 'DeliveryBoysController@store')->name('deliveryboy.store');

            Route::get('/edit/{id}', 'DeliveryBoysController@edit')->name('deliveryboy.edit');
            Route::post('/update/{id}', 'DeliveryBoysController@update')->name('deliveryboy.update');

            Route::get('/destroy/{id}', 'DeliveryBoysController@destroy')->name('deliveryboy.destroy');
        });
        Route::prefix('mainCategories')->group(function () {
            Route::get('/', 'MainCategoriesController@index')->name('maincategory.index');
            Route::get('/create', 'MainCategoriesController@create')->name('maincategory.create');
            Route::post('/store', 'MainCategoriesController@store')->name('maincategory.store');
            Route::get('/edit/{id}', 'MainCategoriesController@edit')->name('maincategory.edit');
            Route::post('/update/{id}', 'MainCategoriesController@update')->name('maincategory.update');
            Route::get('/destroy/{id}', 'MainCategoriesController@destroy')->name('maincategory.destroy');
        });

        Route::prefix('offer')->group(function () {
            Route::get('/', 'OffersController@index')->name('offer.index');
            Route::get('/create', 'OffersController@create')->name('offer.create');
            Route::post('/store', 'OffersController@store')->name('offer.store');
            Route::get('/edit/{id}', 'OffersController@edit')->name('offer.edit');
            Route::post('/update/{id}', 'OffersController@update')->name('offer.update');
            Route::get('/destroy/{id}', 'OffersController@destroy')->name('offer.destroy');
            Route::get('/activation/{id}', 'OffersController@activation')->name('offer.activation');
        });
        Route::prefix('order')->group(function () {
            Route::get('/', 'OrdersController@index')->name('order.index');
        });
        Route::prefix('salary')->group(function () {
            Route::get('/', 'SalariesController@index')->name('salary.index');
            Route::get('/create', 'SalariesController@create')->name('salary.create');
            Route::post('/store', 'SalariesController@store')->name('salary.store');

            Route::get('/edit/{id}', 'SalariesController@edit')->name('salary.edit');
            Route::post('/update/{id}', 'SalariesController@update')->name('salary.update');

            Route::get('/destroy/{id}', 'SalariesController@destroy')->name('salary.destroy');
        });
        Route::prefix('supervisor')->group(function () {
            Route::get('/', 'SupervisorsController@index')->name('supervisor.index');
            Route::get('/create', 'SupervisorsController@create')->name('supervisor.create');
            Route::post('/store', 'SupervisorsController@store')->name('supervisor.store');

            Route::get('/edit/{id}', 'SupervisorsController@edit')->name('supervisor.edit');
            Route::post('/update/{id}', 'SupervisorsController@update')->name('supervisor.update');

            Route::get('/destroy/{id}', 'SupervisorsController@destroy')->name('supervisor.destroy');
        });
        Route::prefix('waiter')->group(function () {
            Route::get('/', 'WaitersController@index')->name('waiter.index');
            Route::get('/create', 'WaitersController@create')->name('waiter.create');
            Route::post('/store', 'WaitersController@store')->name('waiter.store');
            Route::get('/edit/{id}', 'WaitersController@edit')->name('waiter.edit');
            Route::post('/update/{id}', 'WaitersController@update')->name('waiter.update');
            Route::get('/destroy/{id}', 'WaitersController@destroy')->name('waiter.destroy');
        });
    });
});

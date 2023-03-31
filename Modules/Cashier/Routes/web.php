<?php

use App\Models\Cashier;
use App\Models\Manager;
use Illuminate\Support\Facades\DB;

use Modules\Manager\Entities\offer;
use Modules\Manager\Entities\Order;
use Illuminate\Support\Facades\Auth;
use Modules\Manager\Entities\Branch;
use Modules\Manager\Entities\waiter;
use Illuminate\Support\Facades\Route;
use Modules\Manager\Entities\Category;
use Modules\Manager\Entities\supervisor;
use Modules\Manager\Entities\DeliveryBoy;
use Modules\Manager\Entities\MainCategory;
use App\Http\Controllers\Web\WebController;
use Modules\Manager\Entities\DeliveryOrder;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Auth::routes([

//     'register' => false, // Register Routes...

//     'reset' => false, // Reset Password Routes...

//     'verify' => false, // Email Verification Routes...

//   ]);

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'cashier.auth:cashier']
], function () {
    Route::prefix('cashier')->group(function () {
        Route::get('/', 'CashierController@index')->name('cashier.index');
        Route::get('/orders', 'CashierController@orders')->name('cashier.orders');
        Route::post('/getorders', 'CashierController@getorders')->name('cashier.getorders');
        Route::get('/getsingleorder/{id}', 'CashierController@getsingleorder')->name('cashier.getsingleorder');
        Route::get('/shwoonlineorders', 'CashierController@shwoonlineorders')->name('cashier.shwoonlineorders');
        Route::get('/getBranchDeliveryBoys', 'CashierController@getBranchDeliveryBoys')->name('cashier.getBranchDeliveryBoys');
        Route::post('/onlineorders', 'CashierController@onlineorders')->name('cashier.onlineorders');
        Route::post('/updateDeliveryOrder', 'CashierController@updateDeliveryOrder')->name('cashier.updateDeliveryOrder');

        Route::get('/order/categories', 'CashierOrderController@maincategories');
        Route::post('/order/store', 'CashierOrderController@storeorder');
        Route::get('/order/{id}/print', 'CashierOrderController@printorder');
        Route::get('/order/code/{code}', 'CashierOrderController@checkcode');
    });
});

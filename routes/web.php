<?php

use App\Http\Controllers\Web\NewOrderController;
use App\Models\Cashier;
use App\Models\Manager;
use Illuminate\Support\Facades\DB;
use Modules\Manager\Entities\Chef;
use Modules\Manager\Entities\offer;
use Modules\Manager\Entities\Order;
use Modules\Manager\Entities\Branch;
use Modules\Manager\Entities\salary;
use Modules\Manager\Entities\waiter;
use Illuminate\Support\Facades\Route;
use Modules\Manager\Entities\Category;
use Modules\Manager\Entities\supervisor;
use Modules\Manager\Entities\DeliveryBoy;
use Modules\Manager\Entities\MainCategory;
use App\Http\Controllers\Web\WebController;
use Modules\Manager\Entities\ChefAssistant;
use Modules\Manager\Entities\DeliveryOrder;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', [WebController::class, 'index'])->name('index');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {
    // Route::get('/', [WebController::class, 'index'])->name('index');
    Route::get('/welcome', [WebController::class, 'index'])->name('welcome');
    Route::prefix('index')->group(function () {
        Route::get('/', [WebController::class, 'index'])->name('index');
        Route::get('/newOrder', [WebController::class, 'newOrder'])->name('newOrder');
        Route::get('/contact-us', [WebController::class, 'contact'])->name('contact');
        Route::get('/menu', [WebController::class, 'menu'])->name('menu');
        Route::get('/about', [WebController::class, 'about'])->name('about');
    });
    Route::get('/maincategories', [NewOrderController::class, 'getMainCategories']);
    Route::post('/sendordertocashier', [NewOrderController::class, 'sendOrderToCashier']);
    Route::get('/order/code/{code}', [WebController::class, 'checkcode']);
});

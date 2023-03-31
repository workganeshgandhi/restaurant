<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Modules\Manager\Entities\MainCategory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('manager.auth:manager');
    }

    /**
     * Show the Manager dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('manager.home');
    }
    public function testCreate()
    {
        $cat = MainCategory::first();
        return $cat->translate();
        // return config('translatable.locales');
        $main_data = [
            'en' => [
                'name'       => 'english',
            ],
            'ar' => [
                'name'       => 'عربي',
            ],
            'images' => 'ss'
        ];
        $t =  MainCategory::create($main_data);
        if ($t) {
            return true;
        } else {
            return false;
        }
    }
}

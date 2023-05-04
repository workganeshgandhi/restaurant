<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Modules\Manager\Entities\MainCategory;

class HomeController extends Controller
{

    public function __construct()
    {
        //$this->middleware('manager.auth:manager');
    }

    public function index() {
        return view('manager.home');
    }

}

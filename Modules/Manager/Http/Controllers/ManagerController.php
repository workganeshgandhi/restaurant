<?php

namespace Modules\Manager\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ManagerController extends Controller
{
    public function home()
    {
        return view('manager::index');
    }
    public function index()
    {
        return view('manager::pages.manager.index');
    }
    public function create()
    {
        return view('manager::pages.manager.create');
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id)
    {
        return view('manager::show');
    }
    public function edit($id)
    {
        return view('manager::pages.manager.update');
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}

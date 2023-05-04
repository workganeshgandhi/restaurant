<?php

namespace Modules\Manager\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Modules\Manager\Entities\Branch;
use Modules\Manager\Entities\Salary;
use Illuminate\Contracts\Support\Renderable;

class SalariesController extends Controller
{
    public function index(Request $request)
    {
        $salaries = Salary::get();
        return view('manager::pages.salary.index', compact('salaries'));
    }

    public function create()
    {
        return view('manager::pages.salary.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:salaries',
            'mount' => 'required',
        ]);
        try {
            $stored = Salary::create([
                'name' => $request->name,
                'mount' =>  $request->mount,
            ]);
            if ($stored) {
                session()->flash('success', 'added successfuly');
                return redirect()->route('salary.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('salary.index');
        }
    }

    public function edit($id)
    {
        $salary = Salary::find($id);
        if ($salary) {
            return view('manager::pages.salary.edit', compact('salary'));
        } else {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('salary.index');
        }
    }
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required|' . Rule::unique('salaries', 'id')->ignore($id),
            'mount' => 'required',

        ]);
        try {
            $stored = Salary::where('id', $id)->update([
                'name' => $request->name,
                'mount' =>  $request->mount,
            ]);
            if ($stored) {
                session()->flash('success', 'updated successfuly');
                return redirect()->route('salary.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('salary.index');
        }
    }
    public function destroy($id)
    {
        try {
            $salary = Salary::find($id);
            if ($salary) {
                $deleted = $salary->delete();
                if ($deleted) {
                    session()->flash('success', 'deleted successfuly');
                    return redirect()->route('salary.index');
                }
            } else {
                session()->flash('error', 'wrong way');
                return redirect()->route('salary.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('salary.index');
        }
    }
}

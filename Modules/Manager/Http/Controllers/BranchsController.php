<?php

namespace Modules\Manager\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Modules\Manager\Entities\Branch;
use Illuminate\Contracts\Support\Renderable;

class BranchsController extends Controller
{
    public function index()
    {
         $branches = Branch::get();
        return view('manager::pages.branch.index',compact('branches'));
    }

    public function create()
    {
        return view('manager::pages.branch.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|unique:branches',
            'address' => 'required|unique:branches',
            'tables' => 'required',
            'open_date' => 'required',
        ]);
        try {
            $stored = Branch::create([
                'number' => $request->number,
                'address' =>  $request->address,
                'tables' =>  $request->tables,
                'open_date' =>  $request->open_date,
            ]);
            if ($stored) {
                session()->flash('success', 'added successfuly');
                return redirect()->route('branch.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('branch.index');
        }
    }

    public function edit($id)
    {
        $branch = Branch::find($id);
        if ($branch) {
            return view('manager::pages.branch.edit', compact('branch'));
        } else {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('branch.index');
        }
    }
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'number' => 'required|' . Rule::unique('branches', 'id')->ignore($id),
            'address' => 'required|' . Rule::unique('branches', 'id')->ignore($id),
            'tables' => 'required',
            'open_date' => 'required',

        ]);
        try {
            $stored = Branch::where('id', $id)->update([
                'number' => $request->number,
                'address' =>  $request->address,
                'tables' =>  $request->tables,
                'open_date' =>  $request->open_date,
            ]);
            if ($stored) {
                session()->flash('success', 'updated successfuly');
                return redirect()->route('branch.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('branch.index');
        }
    }
    public function destroy($id)
    {
        try {
            $branch = Branch::find($id);
            if ($branch) {
                $deleted = $branch->delete();
                if ($deleted) {
                    session()->flash('success', 'deleted successfuly');
                    return redirect()->route('branch.index');
                }
            } else {
                session()->flash('error', 'wrong way');
                return redirect()->route('branch.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('branch.index');
        }
    }
}

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
        //return $data = Salary::get();
        if ($request->ajax()) {
            $data = Salary::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="' . route("salary.edit", $row->id) . '" class="edit btn btn-dark btn-sm">Update</a>
                    <a href="' . route("salary.destroy", $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#salary' . $row->id . '">
                    view
                    </button>

                    <div class="modal fade" id="salary' . $row->id . '" tabindex="-1" role="dialog" aria-labelledby="salary' . $row->id . 'Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="salary' . $row->id . 'Label">' . $row->name . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                           <div class="col-md-6">
                           <div> <strong>Name</strong>  : ' . $row->name . '</div>
                           </div>
                           <div class="col-md-6">
                           <div> <strong>Mount</strong> : ' . $row->mount . '</div>
                           </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                    </div>


                    ';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('manager::pages.salary.index');
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

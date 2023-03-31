<?php

namespace Modules\Manager\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Modules\Manager\Entities\Branch;
use Modules\Manager\Entities\Salary;
use Modules\Manager\Entities\Chef;
use Illuminate\Contracts\Support\Renderable;

class ChefsController extends Controller
{
    public function index(Request $request)
    {
        //return $data = Chef::with('branch')->get();
        if ($request->ajax()) {
            $data = Chef::with('branch')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="' . route("chef.edit", $row->id) . '" class="edit btn btn-dark btn-sm">Update</a>
                    <a href="' . route("chef.destroy", $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#chef' . $row->id . '">
                    view
                    </button>

                    <div class="modal fade" id="chef' . $row->id . '" tabindex="-1" role="dialog" aria-labelledby="chef' . $row->id . 'Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="chef' . $row->id . 'Label">' . $row->name . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                           <div class="col-md-6">
                           <div> <strong>Name</strong>  : ' . $row->name . '</div>
                           <div><strong>Address</strong>  : ' . $row->address . '</div>
                           <div><strong>Mobile</strong>  : ' . $row->mobile . '</div>
                           <div> <strong>Salary</strong> :' . $row->salary->mount . '</div>
                           </div>
                           <div class="col-md-6">
                           <div> <strong>National_id</strong> : ' . $row->national_id . '</div>
                           <div> <strong>Join_date</strong> : ' . $row->join_date . '</div>
                           <div> <strong>Branch</strong> :' . $row->branch->address . '</div>
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

        return view('manager::pages.chef.index');
    }

    public function create()
    {
        $branches = Branch::get();
        $salaries = Salary::get();
        // return $branches .'&'. $salaries ;
        return view('manager::pages.chef.create', compact('branches', 'salaries'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'mobile' => 'required|unique:chefs|max:12',
            'address' => 'required',
            'join_date' => 'required|date',
            'salary_id' => 'required',
            'branch_id' => 'required',
            'national_id' => 'required|max:14',
        ]);
        try {
            $stored = Chef::create([
                'name' => $request->name,
                'mobile' =>  $request->mobile,
                'address' =>  $request->address,
                'join_date' => $request->join_date,
                'salary_id' =>  $request->salary_id,
                'branch_id' =>  $request->branch_id,
                'national_id' => $request->national_id,
                'salary_state' => 0
            ]);
            if ($stored) {
                session()->flash('success', 'added successfuly');
                return redirect()->route('chef.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('chef.index');
        }
    }

    public function show($id)
    {
        return view('manager::show');
    }
    public function edit($id)
    {
        $chef = Chef::with('branch')->with('salary')->find($id);
        if ($chef) {
            $branches = Branch::get();
            $salaries = Salary::get();
            return view('manager::pages.chef.edit', compact('chef', 'branches', 'salaries'));
        } else {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('chef.index');
        }
    }
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'name' => 'required',
            'mobile' => 'required|' . Rule::unique('chefs', 'id')->ignore($id) . '|max:12',
            'address' => 'required',
            'join_date' => 'required|date',
            'salary_id' => 'required',
            'branch_id' => 'required',
            'national_id' => 'required|max:14',
        ]);
        try {
            $stored = Chef::where('id', $id)->update([
                'name' => $request->name,
                'mobile' =>  $request->mobile,
                'address' =>  $request->address,
                'join_date' => $request->join_date,
                'salary_id' =>  $request->salary_id,
                'branch_id' =>  $request->branch_id,
                'national_id' => $request->national_id,
                'salary_state' => 0
            ]);
            if ($stored) {
                session()->flash('success', 'updated successfuly');
                return redirect()->route('chef.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('chef.index');
        }
    }
    public function destroy($id)
    {
        try {
            $chef = Chef::find($id);
            if ($chef) {
                $deleted = $chef->delete();
                if ($deleted) {
                    session()->flash('success', 'deleted successfuly');
                    return redirect()->route('chef.index');
                }
            } else {
                session()->flash('error', 'wrong way');
                return redirect()->route('chef.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('chef.index');
        }
    }
}

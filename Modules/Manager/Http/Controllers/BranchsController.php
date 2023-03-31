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
    public function index(Request $request)
    {
        //return $data = Branch::get();
        if ($request->ajax()) {
            $data = Branch::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="' . route("branch.edit", $row->id) . '" class="edit btn btn-dark btn-sm">Update</a>
                    <a href="' . route("branch.destroy", $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#branch' . $row->id . '">
                    view
                    </button>

                    <div class="modal fade" id="branch' . $row->id . '" tabindex="-1" role="dialog" aria-labelledby="branch' . $row->id . 'Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="branch' . $row->id . 'Label">' . $row->Address . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                           <div class="col-md-6">
                           <div> <strong>Number</strong>  : ' . $row->number . '</div>
                           <div> <strong>Tables</strong>  : ' . $row->tables . '</div>
                           </div>
                           <div class="col-md-6">
                           <div> <strong>Address</strong> : ' . $row->address . '</div>
                           <div> <strong>Open Date</strong>  : ' . $row->open_date . '</div>
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

        return view('manager::pages.branch.index');
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

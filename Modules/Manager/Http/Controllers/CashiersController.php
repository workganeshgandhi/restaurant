<?php

namespace Modules\Manager\Http\Controllers;

use DataTables;
use App\Models\Cashier;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Manager\Entities\Branch;
use Modules\Manager\Entities\Salary;
use Illuminate\Contracts\Support\Renderable;

class CashiersController extends Controller
{
    public function index(Request $request)
    {
        // return $data = Cashier::with('branch')->get();
        if ($request->ajax()) {
            $data = Cashier::with('branch')->with('salary')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '
                    <a href="' . route("cashier.edit", $row->id) . '" class="edit btn btn-dark btn-sm">Update</a>
                    <a href="' . route("cashier.destroy", $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#cashier' . $row->id . '">
                    view
                    </button>
                    <div class="modal fade" id="cashier' . $row->id . '" tabindex="-1" role="dialog" aria-labelledby="cashier' . $row->id . 'Label" aria-hidden="true" >
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cashier' . $row->id . 'Label">' . $row->name . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-between">
                            <div>
                            <strong> Name : </strong>
                            ' . $row->name . '
                            </div>
                            <div>
                            <strong> Address : </strong>
                            ' . $row->address . '
                            </div>
                            <div >
                            <strong> Address : </strong>
                            ' . $row->mobile . '
                            </div>
                            </div>
                            <div class="d-flex justify-content-between">
                            <div>
                            <strong> Branch : </strong>
                            ' . $row->branch->address . '
                            </div>
                            <div>
                            <strong> Salary : </strong>
                            ' . $row->salary->mount . '
                            </div>
                            <div >
                            <strong> National ID : </strong>
                            ' . $row->national_id . '
                            </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
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

        return view('manager::pages.cashier.index');
    }

    public function create()
    {
        $branches = Branch::get();
        $salaries = Salary::get();
        // return $branches .'&'. $salaries ;
        return view('manager::pages.cashier.create', compact('branches', 'salaries'));
    }

    public function store(Request $request)
    {
        try {

            $stored = Cashier::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'mobile' => $request->mobile,
                'address' => $request->address,
                'national_id' => $request->national_id,
                'salary_id' => $request->salary_id,
                'branch_id' => $request->branch_id,
                'join_date' => $request->join_date,
                'salary_state' => '0',
            ]);
            session()->flash('success', 'created successfuly');
            return redirect()->route('cashier.index');
        } catch (\Exception $e) {
            session()->flash('error', 'someting went wrong , please try later');
            return redirect()->route('cashier.index');
            return $e;
        }
        //  return $request;

        //   return $request;
    }

    public function show($id)
    {
        return view('manager::show');
    }

    public function edit($id)
    {
        $branches = Branch::get();
        $salaries = Salary::get();
        $cashier = Cashier::with('branch')->with('salary')->find($id);
        return view('manager::pages.cashier.update', compact('cashier', 'branches', 'salaries'));
    }

    public function update(Request $request, $id)
    {
        try {
            $updated = Cashier::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'mobile' => $request->mobile,
                'address' => $request->address,
                'national_id' => $request->national_id,
                'salary_id' => $request->salary_id,
                'branch_id' => $request->branch_id,
                'join_date' => $request->join_date,
                'salary_state' => '0',
            ]);
            session()->flash('success', 'updated successfuly');
            return redirect()->route('cashier.index');
        } catch (\Exception $e) {
            session()->flash('error', 'someting went wrong , please try later');
            return redirect()->route('cashier.index');
            return $e;
        }
    }

    public function destroy($id)
    {
        //return $id ;
        try {
            $deleted = Cashier::where('id', $id)->delete();
            session()->flash('success', 'deleted successfuly');
            return redirect()->route('cashier.index');
        } catch (\Exception $e) {
            session()->flash('error', 'someting went wrong , please try later');
            return redirect()->route('cashier.index');
        }
    }
}

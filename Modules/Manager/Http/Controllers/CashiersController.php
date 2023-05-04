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
        $cashiers = Cashier::with('branch')->get();

        return view('manager::pages.cashier.index', compact('cashiers'));
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

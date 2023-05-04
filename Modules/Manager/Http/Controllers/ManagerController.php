<?php

namespace Modules\Manager\Http\Controllers;

use Carbon\Carbon;
use App\Models\Manager;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Modules\Manager\Entities\Branch;
use Modules\Manager\Entities\Salary;
use Illuminate\Contracts\Support\Renderable;

class ManagerController extends Controller
{
    public function home()
    {
        return view('manager::index');
    }
    public function index()
    {
        $managers = Manager::with('branch', 'salary')->get();
        return view('manager::pages.manager.index', compact('managers'));
    }
    public function create()
    {
        $salaries = Salary::get();
        $branches = Branch::get();
        return view('manager::pages.manager.create', compact('salaries', 'branches'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:managers',
            'mobile' => 'required|unique:managers|max:12',
            'address' => 'required',
            'join_date' => 'required|date',
            'salary_id' => 'required',
            'branch_id' => 'required',
            'national_id' => 'required|max:14',
            'password' => 'required|min:8',
        ]);
        try {
            $stored = Manager::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' =>  $request->mobile,
                'address' =>  $request->address,
                'join_date' => $request->join_date,
                'salary_id' =>  $request->salary_id,
                'branch_id' =>  $request->branch_id,
                'password' => $request->password,
                'national_id' => $request->national_id,
                'salary_state' => 0
            ]);
            if ($stored) {
                session()->flash('success', 'added successfuly');
                return redirect()->route('managers.index');
            }
        } catch (\Exception $e) {
            return $e;
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('managers.index');
        }
    }
    public function edit($id)
    {
        $manager = Manager::with('branch', 'salary')->where('id', $id)->first();
        $salaries = Salary::get();
        $branches = Branch::get();
        return view('manager::pages.manager.update', compact('manager', 'salaries', 'branches'));
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile' => 'required|' . Rule::unique('managers', 'id')->ignore($id) . '|max:12',
            'address' => 'required',
            'join_date' => 'required|date',
            'salary_id' => 'required',
            'branch_id' => 'required',
            'national_id' => 'required|max:14',
            'password' => 'required|min:8',
        ]);
        try {
            $stored = Manager::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' =>  $request->mobile,
                'address' =>  $request->address,
                'join_date' => $request->join_date,
                'salary_id' =>  $request->salary_id,
                'branch_id' =>  $request->branch_id,
                'national_id' => $request->national_id,
                'password' => $request->password
            ]);
            if ($stored) {
                session()->flash('success', 'updated successfuly');
                return redirect()->route('managers.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('managers.index');
        }
    }
    public function destroy($id)
    {
        try {
            $manager = Manager::find($id);
            if ($manager) {
                $deleted = $manager->delete();
                if ($deleted) {
                    session()->flash('success', 'deleted successfuly');
                    return redirect()->route('managers.index');
                }
            } else {
                session()->flash('error', 'wrong way');
                return redirect()->route('managers.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('managers.index');
        }
    }
}

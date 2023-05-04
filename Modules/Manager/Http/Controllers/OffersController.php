<?php

namespace Modules\Manager\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Modules\Manager\Entities\Branch;
use Modules\Manager\Entities\Offer;
use Illuminate\Contracts\Support\Renderable;

class OffersController extends Controller
{
    public function index(Request $request)
    {
        $offers = Offer::get();

        return view('manager::pages.offer.index', compact('offers'));
    }

    public function create()
    {
        return view('manager::pages.offer.create');
    }
    public function store(Request $request)
    {

        if ($request->discount == null) {
            $request['discount'] = 0;
        } elseif ($request->percentage == null) {
            $request['percentage'] = 0;
        }
        //return $request;
        $validated = $request->validate([
            'name' => 'required|unique:offers',
            'code' => 'required|unique:offers',
            'discount' => 'required_without:percentage',
            'percentage' => 'required_without:discount',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
        ]);
        try {
            $stored = Offer::create([
                'name' => $request->name,
                'code' => $request->code,
                'discount' =>  $request->discount,
                'percentage' =>  $request->percentage,
                'start_at' =>  $request->start_at,
                'end_at' =>  $request->end_at,
                'active' =>  0,
            ]);
            if ($stored) {
                session()->flash('success', 'added successfuly');
                return redirect()->route('offer.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('offer.index');
        }
    }

    public function edit($id)
    {
        $offer = Offer::find($id);
        if ($offer) {
            return view('manager::pages.offer.edit', compact('offer'));
        } else {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('offer.index');
        }
    }
    public function update(Request $request, $id)
    {
        if ($request->discount == null) {
            $request['discount'] = 0;
        } elseif ($request->percentage == null) {
            $request['percentage'] = 0;
        }
        $validated = $request->validate([
            'name' => 'required|' . Rule::unique('offers', 'id')->ignore($id),
            'code' => 'required|' . Rule::unique('offers', 'code')->ignore($id),
            'discount' => 'required_without:percentage',
            'percentage' => 'required_without:discount',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
        ]);
        try {
            $stored = Offer::where('id', $id)->update([
                'name' => $request->name,
                'code' => $request->code,
                'discount' =>  $request->discount,
                'percentage' =>  $request->percentage,
                'start_at' =>  $request->start_at,
                'end_at' =>  $request->end_at,
            ]);
            if ($stored) {
                session()->flash('success', 'updated successfuly');
                return redirect()->route('offer.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('offer.index');
        }
    }
    public function destroy($id)
    {
        try {
            $offer = Offer::find($id);
            if ($offer) {
                $deleted = $offer->delete();
                if ($deleted) {
                    session()->flash('success', 'deleted successfuly');
                    return redirect()->route('offer.index');
                }
            } else {
                session()->flash('error', 'wrong way');
                return redirect()->route('offer.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('offer.index');
        }
    }
    public function activation($id)
    {
        $offer = Offer::find($id);
        if ($offer->active == 1) {
            $offer->update([
                'active' => 0,
            ]);
            return 0;
        } elseif ($offer->active == 0) {
            $offer->update([
                'active' => 1,
            ]);
            return 1;
        }
    }
}

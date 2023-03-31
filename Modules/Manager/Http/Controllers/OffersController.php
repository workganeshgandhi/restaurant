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
        //return $data = Offer::get();
        if ($request->ajax()) {
            $data = Offer::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $activeClass = '';
                    $changeTo = '';
                    if ($row->active == 1) {
                        $activeClass = 'btn-danger';
                        $changeTo = 'Inactive';
                    } else {
                        $activeClass = 'btn-success';
                        $changeTo = 'Active';
                    }
                    $btn = '
                    <button type="submit" id="get'.$row->id.'" data-url="' . route('offer.activation', $row->id) . '" data-offer="' . $row->id . '" class="changeBtn edit btn ' . $activeClass . ' btn-sm">' . $changeTo . '</button>

                    <a href="' . route("offer.edit", $row->id) . '" class="edit btn btn-dark btn-sm">Update</a>
                    <a href="' . route("offer.destroy", $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#offer' . $row->id . '">
                    view
                    </button>

                    <div class="modal fade" id="offer' . $row->id . '" tabindex="-1" role="dialog" aria-labelledby="offer' . $row->id . 'Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="offer' . $row->id . 'Label">' . $row->name . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                           <div class="col-md-6">
                           <div> <strong>Name</strong>  : ' . $row->name . '</div>
                           <div> <strong>Discount</strong> : ' . $row->discount . '</div>
                           <div> <strong>Percentage</strong> : ' . $row->percentage . '</div>

                           </div>
                           <div class="col-md-6">
                           <div> <strong>Start at</strong> : ' . $row->start_at . '</div>
                           <div> <strong>End at</strong> : ' . $row->end_at . '</div>

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

        return view('manager::pages.offer.index');
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
            'discount' => 'required_without:percentage',
            'percentage' => 'required_without:discount',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
        ]);
        try {
            $stored = Offer::create([
                'name' => $request->name,
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
            'discount' => 'required_without:percentage',
            'percentage' => 'required_without:discount',
            'start_at' => 'required|date',
            'end_at' => 'required|date',
        ]);
        try {
            $stored = Offer::where('id', $id)->update([
                'name' => $request->name,
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

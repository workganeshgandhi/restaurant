<?php

namespace Modules\Manager\Http\Controllers;

use Datatables;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Manager\Entities\Branch;
use Modules\Manager\Entities\Order;
use Modules\Manager\Entities\Cashier;


class OrdersController extends Controller
{
    public function index(Request $request)
    {
      return  $data = Order::with('categories')->get();
        if ($request->ajax()) {
            $data = Order::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#salary' . $row->id . '">
                    view
                    </button>

                    <div class="modal fade" id="salary' . $row->id . '" tabindex="-1" role="dialog" aria-labelledby="salary' . $row->id . 'Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="salary' . $row->id . 'Label">' . $row->number . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                           <div class="col-md-6">
                           <div> <strong>Name</strong>  : ' . $row->number . '</div>
                           </div>
                           <div class="col-md-6">
                           <div> <strong>Mount</strong> : ' . $row->number . '</div>
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

        return view('manager::pages.order.index');
    }
}

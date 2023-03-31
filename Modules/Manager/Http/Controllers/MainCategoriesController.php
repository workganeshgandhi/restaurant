<?php

namespace Modules\Manager\Http\Controllers;


use DataTables;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Modules\Manager\Entities\MainCategory;
use Illuminate\Contracts\Support\Renderable;
use Astrotomic\Translatable\Locales;
use Astrotomic\Translatable\Translatable;

class MainCategoriesController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = MainCategory::with('categories')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $categories = '';
                    if (!$row->categories->isEmpty()) {
                        foreach ($row->categories as $category) {
                            $categories .= '<a class="btn btn-sm btn-info mr-2 ml-2" href="' . route('maincategory.index') . '"> ' . $category->name . ' </a>';
                        }
                    } else {
                        $categories = 'No Categories Avilable Yet';
                    }
                    $decoded = json_decode($row->images);
                    $images = '';
                    foreach ($decoded as $image) {
                        $path = asset('uploaded/MainCategory/' . $image);
                        $images .= '<img class="image-style mr-4" src="' . $path . '" alt="">';
                    }
                    $btn = '

                    <a href="' . route("maincategory.edit", $row->id) . '" class="edit btn btn-dark btn-sm">Update</a>
                    <a href="' . route("maincategory.destroy", $row->id) . '" class="edit btn btn-danger btn-sm">Delete</a>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#maincategory' . $row->id . '">
                    view
                    </button>

                    <div class="modal fade" id="maincategory' . $row->id . '" tabindex="-1" role="dialog" aria-labelledby="maincategory' . $row->id . 'Label" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="maincategory' . $row->id . 'Label">' . $row->name . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                           <div class="w-100 mb-4 d-flex justify-content-center">
                           <div>' . $images . '</div>
                           </div>

                           <div class="w-100 d-flex justify-content-start">
                           <strong> Categories : </strong>
                           ' . $categories . '
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

        return view('manager::pages.maincategory.index');
    }
    public function create()
    {
        return view('manager::pages.maincategory.create');
    }
    public function store(Request $request)
    {
        //return $request->en['name'];
        // return $request;
        $validated = $request->validate([
            'ar.name' => 'Required|unique:main_category_translations,name',
            'en.name' => 'Required|unique:main_category_translations,name',
            'images.*' => 'image|mimes:jpeg,png,jpg'
        ]);
        //return $request;

        try {

            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $index => $file) {
                    $name = $request->name . ++$index . '.' . $file->extension();
                    $file->move(public_path() . '/uploaded/MainCategory/', $name);
                    $images[] = $name;
                }
                $data = [
                    'en' => [
                        'name'       => $request->en['name'],
                    ],
                    'ar' => [
                        'name'       => $request->ar['name'],
                    ],
                    'images' => json_encode($images)
                ];
            } else {
                $data = [
                    'en' => [
                        'name'       => $request->en['name'],
                    ],
                    'ar' => [
                        'name'       => $request->ar['name'],
                    ],
                    'images' => json_encode(['default.gif'])
                ];
            }
            $stored = MainCategory::create($data);
            if ($stored) {
                session()->flash('success', 'added successfuly');
                return redirect()->route('maincategory.index');
            }
        } catch (\Exception $e) {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('maincategory.index');
        }
    }
    public function edit($id)
    {
        $maincategory = MainCategory::find($id);
        if ($maincategory) {
            return view('manager::pages.maincategory.edit', compact('maincategory'));
        } else {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('maincategory.index');
        }
    }
    public function update(Request $request, $id)
    {

        $validated = $request->validate([
            'en.name' => 'Required|' . Rule::unique('main_category_translations', 'name')->ignore($id, 'main_category_id'),
            'ar.name' => 'Required|' . Rule::unique('main_category_translations', 'name')->ignore($id, 'main_category_id'),
            'images.*' => 'image|mimes:jpeg,png,jpg'
        ]);
        try {
            if ($request->hasfile('images')) {
                $old = MainCategory::find($id);
                $decoded = json_decode($old->images);

                if ($decoded != ["default.gif"]) {
                    foreach ($decoded as $image) {
                        $file_deleted = File::delete(public_path('/uploaded/MainCategory/') . $image);
                    }
                }
                foreach ($request->file('images') as $index => $file) {
                    $name = $request->name . ++$index . '.' . $file->extension();
                    $file->move(public_path() . '/uploaded/MainCategory/', $name);
                    $images[] = $name;
                }
                $data = [
                    'en' => [
                        'name'       => $request->en['name'],
                    ],
                    'ar' => [
                        'name'       => $request->ar['name'],
                    ],
                    'images' => json_encode($images)
                ];
            } else {
                $data = [
                    'en' => [
                        'name'       => $request->en['name'],
                    ],
                    'ar' => [
                        'name'       => $request->ar['name'],
                    ]
                ];
            }
            $stored = MainCategory::findOrFail($id)->update($data);
            if ($stored) {
                session()->flash('success', 'updated successfuly');
                return redirect()->route('maincategory.index');
            }

            if ($stored) {
                session()->flash('success', 'updated successfuly');
                return redirect()->route('maincategory.index');
            }
        } catch (\Exception $e) {
            return $e;
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('maincategory.index');
        }
    }
    public function destroy($id)
    {
        try {
            $maincategory = MainCategory::find($id);
            $decoded = json_decode($maincategory->images);
            if ($maincategory) {
                $maincategory->translations()->delete();
                $deleted = $maincategory->delete();
                if ($deleted && $decoded != 'default.gif') {
                    foreach ($decoded as $image) {
                        $file_deleted = File::delete(public_path('/uploaded/MainCategory/') . $image);
                    }
                    if ($file_deleted) {
                        session()->flash('success', 'deleted successfuly');
                        return redirect()->route('maincategory.index');
                    } else {
                        session()->flash('error', 'wrong way');
                        return redirect()->route('maincategory.index');
                    }
                }
                else {
                    session()->flash('success', 'deleted successfuly');
                    return redirect()->route('maincategory.index');
                }
            } else {
                session()->flash('error', 'wrong way');
                return redirect()->route('maincategory.index');
            }
        } catch (\Exception $e) {

            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('maincategory.index');
        }
    }
}

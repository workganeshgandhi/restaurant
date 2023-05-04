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
        $mains = MainCategory::with('categories')->get();

        return view('manager::pages.maincategory.index', compact('mains'));
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
                } else {
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

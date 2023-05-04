<?php

namespace Modules\Manager\Http\Controllers;

use DataTables;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Modules\Manager\Entities\Category;
use Illuminate\Support\Facades\Validator;
use Modules\Manager\Entities\MainCategory;
use Illuminate\Contracts\Support\Renderable;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('main_category')->latest()->get();
        return view('manager::pages.category.index', compact('categories'));
    }

    public function create()
    {
        $mains = MainCategory::get();
        return view('manager::pages.category.create', compact('mains'));
    }
    public function store(Request $request)
    {
        // return $request->en['name'];

        $validated = $request->validate([
            'ar.name' => 'required|unique:category_translations,name',
            'en.name' => 'Required|unique:category_translations,name',
            'main_category_id' => 'Required',
            'price' => 'required|numeric|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg'
        ]);
        //return $request;

        try {

            if ($request->hasfile('images')) {
                foreach ($request->file('images') as $index => $file) {
                    $name = $request->en['name'] . ++$index . '.' . $file->extension();
                    $file->move(public_path() . '/uploaded/Category/', $name);
                    $images[] = $name;
                }
                $data = [
                    'en' => [
                        'name'       => $request->en['name'],
                    ],
                    'ar' => [
                        'name'       => $request->ar['name'],
                    ],
                    'main_category_id' => $request->main_category_id,
                    'price' => $request->price,
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
                    'main_category_id' => $request->main_category_id,
                    'price' => $request->price,
                    'images' => json_encode(['default.gif'])
                ];
            }
            $stored = Category::create($data);
            if ($stored) {
                session()->flash('success', 'added successfuly');
                return redirect()->route('category.index');
            }
        } catch (\Exception $e) {
            return $e;
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('category.index');
        }
    }

    public function edit($id)
    {
        $category = Category::find($id);
        $mains = MainCategory::get();
        if ($category) {
            return view('manager::pages.category.edit', compact('category', 'mains'));
        } else {
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('category.index');
        }
    }
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'en.name' => 'Required|' . Rule::unique('category_translations', 'name')->ignore($id, 'category_id'),
            'ar.name' => 'Required|' . Rule::unique('category_translations', 'name')->ignore($id, 'category_id'),
            'main_category_id' => 'Required',
            'price' => 'Required',
            'images.*' => 'image|mimes:jpeg,png,jpg'
        ]);
        try {
            if ($request->hasfile('images')) {
                $old = Category::find($id);
                $decoded = json_decode($old->images);

                if ($decoded != ["default.gif"]) {
                    foreach ($decoded as $image) {
                        $file_deleted = File::delete(public_path('/uploaded/Category/') . $image);
                    }
                }
                foreach ($request->file('images') as $index => $file) {
                    $name = $request->name . ++$index . '.' . $file->extension();
                    $file->move(public_path() . '/uploaded/Category/', $name);
                    $images[] = $name;
                }
                $data = [
                    'en' => [
                        'name'       => $request->en['name'],
                    ],
                    'ar' => [
                        'name'       => $request->ar['name'],
                    ],
                    'price' => $request->price,
                    'main_category_id' => $request->main_category_id,
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
                    'price' => $request->price,
                    'main_category_id' => $request->main_category_id,
                ];
            }
            $stored = Category::findOrFail($id)->update($data);
            if ($stored) {
                session()->flash('success', 'updated successfuly');
                return redirect()->route('category.index');
            }

            if ($stored) {
                session()->flash('success', 'updated successfuly');
                return redirect()->route('category.index');
            }
        } catch (\Exception $e) {
            return $e;
            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('category.index');
        }
    }
    public function destroy($id)
    {
        try {
            $category = Category::find($id);
            $decoded = json_decode($category->images);
            if ($category) {
                $category->translations()->delete();
                $deleted = $category->delete();

                if ($deleted  && $decoded != ["default.gif"]) {
                    foreach ($decoded as $image) {
                        $file_deleted = File::delete(public_path('/uploaded/Category/') . $image);
                    }
                    if ($file_deleted) {
                        session()->flash('success', 'deleted successfuly');
                        return redirect()->route('category.index');
                    } else {
                        session()->flash('error', 'wrong way');
                        return redirect()->route('category.index');
                    }
                } else {
                    session()->flash('success', 'deleted successfuly');
                    return redirect()->route('category.index');
                }
            } else {
                session()->flash('error', 'wrong way');
                return redirect()->route('category.index');
            }
        } catch (\Exception $e) {

            session()->flash('error', 'sorry , some thing went wrong  . try later');
            return redirect()->route('category.index');
        }
    }
}

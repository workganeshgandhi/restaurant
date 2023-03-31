<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Modules\Manager\Entities\Offer;
use App\Http\Controllers\Controller;
use Modules\Manager\Entities\Category;
use Modules\Manager\Entities\MainCategory;

class WebController extends Controller
{

    public function index()
    {
        $menu = Category::get();
        foreach ($menu as  $index =>  $item) {
            //  return $item;
            $decoded = json_decode($item->images);
            $images = '';
            foreach ($decoded as $image) {
                $path = asset('uploaded/Category/' . $image);
                $images = '<img class="item-img" src="' . $path . '"  alt="">';
            }
            $menu[$index]->images = $images;
        }
        return view('web.index', compact('menu'));
    }
    public function newOrder()
    {
        return view('web.newOrder');
    }
    public function contact()
    {
        return view('web.contact');
    }
    public function menu()
    {
        $main_cat = MainCategory::with('categories')->get();
        foreach ($main_cat as  $index =>  $main) {
            foreach ($main->categories as $key => $item) {
                $decoded = json_decode($item->images);
                $images = '';
                foreach ($decoded as $image) {
                    $path = asset('uploaded/Category/' . $image);
                    $images = '<img class="item-img" src="' . $path . '"  alt="">';
                }
                $main_cat[$index]->categories[$key]->images = $images;
            }
        }
        return view('web.menu', compact('main_cat'));
    }
    public function about()
    {
        return view('web.about');
    }
    public function checkcode($code)
    {
        $offer = Offer::where('code', $code)->get();
        return response()->json($offer);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\SeasonRequest;


class ProductController extends Controller
{
    public function index() {
        $seasons = Season::with('products')->paginate(6);
        $products = Product::with('seasons')->get();
        return view('products', compact('seasons','products'));
    }

    public function getRegister() {
        $seasons = Season::with('products')->get();
        return view('register', compact('seasons'));
    }

    public function postRegister(Request $request) {
        $seasons = Season::with('products')->get();
        // 画像を保存
        $imagePath = $request->file('image')->store('images', 'public');
        // 保存された画像のURLを取得
        $image = asset('storage/' . $imagePath);
        return view('products');
    }

    public function store(Request $request) {
        $seasons = Season::with('products')->scopeProductId($request->id)->get();
        $products = Product::with('seasons')->get();
        $productId = $products->only(['id','name','price','image','description']);
        dd($prooductId);
        return view('detail', $productId);
    }

    public function image() {
        $seasons = Season::with('products')->get();

        //画像のアップロード
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('uploads', 'public');

            Product::create([
                'name' => $request->name,
                'image' => $image,
            ]);
        }
        return view('detail', compact('seasons'));
    }

    public function detail() {
        $seasons = Season::with('products')->get();
        return view('detail', compact('seasons'));
    }
}
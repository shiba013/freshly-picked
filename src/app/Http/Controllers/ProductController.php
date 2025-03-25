<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\SeasonRequest;
use App\Http\Requests\ProductSeasonRequest;


class ProductController extends Controller
{
    public function index()
    {
        $seasons = Season::with('products')->paginate(6);
        $products = Product::with('seasons')->get();
        return view('products', compact('seasons','products'));
    }

    public function register()
    {
        $seasons = Season::with('products')->get();
        return view('register', compact('seasons'));
    }

    public function create(ProductSeasonRequest $request)
    {
        if ($request->has('back')) {
            return view('/products');
        }

        $seasons = Season::with('products')->get();
        $season = Season::create($request->only(['name']));

        $image = $request->file('image')->store('images', 'public');
        $request['image'] = $image;
        $product = $request->only(['name','price','image','description']);
        Product::create($product);
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
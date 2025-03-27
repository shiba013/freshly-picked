<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index()
    {
        $seasons = Season::with('products')->get();
        $products = Product::with('seasons')->paginate(6);
        return view('products', compact('seasons','products'));
    }

    public function search(Request $request)
    {
        if ($request->has('reset')) {
            return redirect('/products');
        }

        $products = Product::with('seasons')
        ->NameSearch($request->name)
        ->KeywordSearch($request->keyword)
        ->PriceSort($request->sort)
        ->paginate(6);
        $seasons = Season::with('products')->get();
        return view('products', compact('products', 'seasons'));
    }

    public function detail($productId)
    {
        $product = Product::with('seasons')->find($productId);
        $seasons = Season::with('products')->get();
        $seasonIds = $product->seasons->pluck('id')->toArray();
        return view('detail', compact('product', 'seasons', 'seasonIds'));
    }

    public function update(ProductRequest $request, $productId)
    {
        $product = Product::with('seasons')->find($productId);

        $imagePath = $request->file('image')
        ->storeAs('public/images', $request
        ->file('image')->getClientOriginalName());

        $product = Product::update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);
        $product->seasons()->sync($request->seasons,false);
        return redirect('/products');
    }

    public function destroy(Request $request)
    {
        Product::find($request->id)->delete();
        return redirect('/products');
    }

    public function register()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    public function create(ProductRequest $request)
    {
        //画像の保存
        $image = $request->file('image')->getClientOriginalName();
        $imagePath = 'images/' . $image;
        $request->file('image')->storeAs('images', basename($imagePath), 'public');
        //Storage::put('public/fruits-img', $filename);

        //商品の保存
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        // 選択された季節を商品に関連付けて保存
        $product->seasons()->attach($request->seasons);

        return redirect('/products');
    }

/*
    public function preview($filename)
    {
        $path = storage_path("app/public/fruits-img/{$filename}");
        return response()->file($path);
    }

    public function store(Request $request) {
        $seasons = Season::with('products')->scopeProductId($request->id)->get();
        $products = Product::with('seasons')->get();
        $productId = $products->only(['id','name','price','image','description']);
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
    */
}
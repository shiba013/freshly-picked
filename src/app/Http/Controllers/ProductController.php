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

        $image = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('images', basename($image), 'public');

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image,
            'description' => $request->description,
        ]);

        $product->seasons()->sync($request->seasons);
        return redirect('/products');
    }

    public function destroy(Request $request, $productId)
    {
        Product::with('seasons')->find($productId)->delete();
        return redirect('/products');
    }

    public function register()
    {
        $seasons = Season::all();
        return view('register', compact('seasons'));
    }

    public function create(ProductRequest $request)
    {
        $image = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('images', basename($image), 'public');

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $image,
            'description' => $request->description,
        ]);
        $product->seasons()->attach($request->seasons);
        return view('products');
    }
}
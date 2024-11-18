<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->filled('sort')) {
            $query->orderBy('price', $request->input('sort'));
        }

        $products = $query->paginate(6);

        return view('products.index', compact('products'));
    }

    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.show', compact('product'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request)
    {

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->season = $request->season;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', '商品が登録されました。');
    }

    public function update(ProductRequest $request, $productId)
    {
        $product = Product::findOrFail($productId);

    $product->name = $request->name;
    $product->price = $request->price;
    $product->description = $request->description;
    $product->season = $request->season;

    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $imagePath = $request->file('image')->store('images', 'public');
        $product->image = $imagePath;
    }

    $product->save();

    return redirect()->route('products.index')->with('success', '商品情報が更新されました。');
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();
        return redirect()->route('products.index');
    }
}